#!/usr/bin/env bash
# Pemeriksa kondisi sehat proyek Hyundai Makassar.
#
# Dipakai untuk memverifikasi hasil kerja coding agent secara mandiri —
# laporan agent TIDAK boleh dipercaya tanpa output ini.
#
# Pemakaian:  bash scripts/cek-sehat.sh
#
# Keluar dengan kode 1 kalau ada yang gagal, supaya bisa dipakai di CI.

set -uo pipefail

cd "$(dirname "$0")/.." || exit 1

export LD_LIBRARY_PATH=/home/liinz/.local/lib/icu78
export PHP_INI_SCAN_DIR="/etc/php/8.5/cli/conf.d:/home/liinz/.local/php-ext/conf.d"

BASE=http://127.0.0.1:8000
GAGAL=0

gagal() {
    echo "  ✗ $1"
    GAGAL=1
}

lulus() {
    echo "  ✓ $1"
}

echo "=== 1. Konfigurasi yang TIDAK boleh berubah ==="
for kv in "APP_ENV=local" "APP_DEBUG=false" "SESSION_SECURE_COOKIE=false"; do
    k="${kv%%=*}"
    v="${kv##*=}"
    aktual=$(grep -E "^${k}=" .env 2>/dev/null | head -1 | cut -d= -f2-)
    if [ "$aktual" = "$v" ]; then
        lulus "$k=$v"
    else
        gagal "$k harus '$v', ternyata '$aktual'"
    fi
done

if [ -f bootstrap/cache/config.php ]; then
    gagal "bootstrap/cache/config.php ADA — config ter-cache membekukan path DB (test bisa menulis ke data asli). Hapus file itu."
else
    lulus "tidak ada config cache"
fi

echo
echo "=== 2. Data asli utuh ==="
data=$(php -r '
$p = new PDO("sqlite:database/database.sqlite");
echo $p->query("SELECT COUNT(*) FROM users")->fetchColumn(), " ",
     $p->query("SELECT COUNT(*) FROM sales")->fetchColumn(), " ",
     $p->query("SELECT COUNT(*) FROM galeri")->fetchColumn();
' 2>/dev/null)
set -- $data
[ "${1:-0}" -ge 2 ] && lulus "users: $1" || gagal "users: ${1:-0} (harus >= 2)"
[ "${2:-0}" -ge 1 ] && lulus "sales: $2" || gagal "sales: ${2:-0} (harus >= 1)"
[ "${3:-0}" -ge 7 ] && lulus "galeri: $3" || gagal "galeri: ${3:-0} (harus >= 7)"

webp=$(ls storage/app/public/galeri/*.webp 2>/dev/null | wc -l)
[ "$webp" -ge 7 ] && lulus "file webp: $webp" || gagal "file webp: $webp (harus >= 7)"

echo
echo "=== 2b. Tidak ada akun asing / lemah ==="
# Akun yang TIDAK seharusnya ada di produksi: user di luar daftar resmi.
# Pernah terjadi: DatabaseSeeder memanggil User::factory() sehingga user
# acak ber-password 'password' dengan role admin masuk ke database asli.
asing=$(php -r '
$p = new PDO("sqlite:database/database.sqlite");
$q = $p->query("SELECT username, role FROM users WHERE username NOT IN (\"admin\",\"rukman.fadli\")");
$n = 0;
foreach ($q as $r) { echo $r["username"]."(".$r["role"].") "; $n++; }
' 2>/dev/null)
if [ -z "$asing" ]; then
    lulus "tidak ada akun di luar admin & rukman.fadli"
else
    gagal "akun asing ditemukan: $asing"
fi

# Cek password lemah 'password' pada akun yang ada. Membutuhkan artisan,
# jadi dilakukan terpisah supaya skrip tetap jalan tanpa PHP app bootstrap.
lemah=$(php -r '
require "vendor/autoload.php";
$app = require "bootstrap/app.php";
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
$n = 0;
foreach (App\Models\User::all() as $u) {
    if (Illuminate\Support\Facades\Hash::check("password", $u->password)) {
        echo $u->username." ";
        $n++;
    }
}
' 2>/dev/null)
if [ -z "$lemah" ]; then
    lulus "tidak ada akun ber-password 'password'"
else
    gagal "akun ber-password 'password' (BAHAYA): $lemah"
fi

echo
echo "=== 3. Test suite ==="
# Output php artisan test memuat kode warna ANSI, jadi dibersihkan dulu
# sebelum dicocokkan — kalau tidak, pola "Tests: N passed" tidak akan ketemu.
out=$(php artisan test --no-ansi 2>&1 | sed 's/\x1b\[[0-9;]*m//g')
if echo "$out" | grep -qE "^\s+Tests:\s+[0-9]+ passed"; then
    lulus "$(echo "$out" | grep -oE '[0-9]+ passed \([0-9]+ assertions\)' | head -1)"
else
    gagal "ada test yang gagal:"
    echo "$out" | grep -E "^\s+Tests:|FAILED" | sed 's/^/      /' | head -5
fi

echo
echo "=== 4. Halaman HTTP ==="
cek() { # path, kode yang diharapkan
    kode=$(curl -s -o /dev/null -w '%{http_code}' --max-time 10 "$BASE$1")
    if [ "$kode" = "$2" ]; then
        lulus "$1 → $kode"
    else
        gagal "$1 → $kode (diharapkan $2)"
    fi
}
cek "/login" 200
cek "/login/admin" 302
cek "/login/sales" 302
cek "/admin/login" 302
cek "/admin" 302
cek "/sales" 302
cek "/?s=rukman-fadli" 200

slide=$(curl -s --max-time 10 "$BASE/?s=rukman-fadli" | grep -c "swiper-slide")
[ "$slide" -eq 7 ] && lulus "beranda: $slide slide" || gagal "beranda: $slide slide (harus 7)"

echo
if [ "$GAGAL" -eq 0 ]; then
    echo "SEMUA SEHAT ✓"
else
    echo "ADA MASALAH ✗"
fi
exit "$GAGAL"
