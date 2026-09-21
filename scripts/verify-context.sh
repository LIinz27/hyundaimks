#!/usr/bin/env bash
# Verifikasi independen G2: pastikan konteks sales menempel di semua halaman
# dan semua link internal. Skrip ini milik orkestrator, bukan OpenCode —
# tujuannya memeriksa klaim secara terpisah.
#
# Pakai: bash scripts/verify-context.sh [base_url]
set -u

BASE="${1:-http://127.0.0.1:8000}"
SLUG="rukman-fadli"

PAGES=(
  "/"
  "/pricelist"
  "/proses-kredit"
  "/simulasi-kredit"
  "/tes-drive"
  "/portofolio"
  "/kontak"
  "/product/stargazer"
  "/product/creta"
  "/product/stargazer-x"
  "/product/hyundai-kona"
  "/product/santa-fe"
  "/product/staria"
  "/product/ioniq-5"
  "/product/palisade"
  "/product/ioniq-6"
  "/product/all-new-santa-fe"
)

code() { curl -s -o /dev/null -w '%{http_code}' --max-time 8 "$1"; }

echo "=================================================================="
echo "A. Setiap halaman: 200 dengan konteks, 404 tanpa konteks"
echo "=================================================================="
fail=0
printf '%-30s %-8s %-8s\n' "HALAMAN" "DENGAN" "TANPA"
for p in "${PAGES[@]}"; do
  with=$(code "$BASE$p?s=$SLUG")
  without=$(code "$BASE$p")
  printf '%-30s %-8s %-8s\n' "$p" "$with" "$without"
  [ "$with" = "200" ] || { echo "   ^ GAGAL: harus 200 dengan konteks"; fail=$((fail+1)); }
  [ "$without" = "404" ] || { echo "   ^ GAGAL: harus 404 tanpa konteks"; fail=$((fail+1)); }
done
echo "Kegagalan bagian A: $fail"

echo
echo "=================================================================="
echo "B. Semua link internal di setiap halaman mengembalikan 200"
echo "=================================================================="
# Link internal bisa berupa absolut (http://host/path) atau relatif (/path).
# Normalisasi ke path saja.
normalize() { sed -E "s#^https?://[^/]+##" ; }
dead=0
for p in "${PAGES[@]}"; do
  links=$(curl -s --max-time 8 "$BASE$p?s=$SLUG" \
    | grep -oE 'href="[^"]+"' | sed 's/^href="//;s/"$//' \
    | grep -E '^(https?://)?/|^https?://[^/]+/' \
    | grep -vE '/(admin|storage|build|images)|\.(css|js|png|jpg|jpeg|webp|svg|ico|woff2?)$' \
    | grep -E "^$BASE|^/" | normalize | sort -u)
  for l in $links; do
    c=$(code "$BASE$l")
    if [ "$c" != "200" ]; then
      printf '  MATI: %-45s (%s) di %s\n' "$l" "$c" "$p"
      dead=$((dead+1))
    fi
  done
done
echo "Link mati: $dead"

echo
echo "=================================================================="
echo "C. Link internal membawa parameter ?s="
echo "=================================================================="
missing=0
for p in "${PAGES[@]}"; do
  links=$(curl -s --max-time 8 "$BASE$p?s=$SLUG" \
    | grep -oE 'href="[^"]+"' | sed 's/^href="//;s/"$//' \
    | grep -E '^(https?://)?/|^https?://[^/]+/' \
    | grep -vE '/(admin|storage|build|images)|\.(css|js|png|jpg|jpeg|webp|svg|ico|woff2?)$' \
    | grep -E "^$BASE|^/" | normalize | sort -u)
  tot=$(printf '%s\n' "$links" | grep -c . || true)
  n=$(printf '%s\n' "$links" | grep -c '?s=' || true)
  printf '  %-30s %s/%s link membawa ?s=\n' "$p" "$n" "$tot"
  [ "$n" -eq "$tot" ] || { missing=$((missing+1)); printf '%s\n' "$links" | grep -v '?s=' | sed 's/^/      TANPA ?s=: /'; }
done
echo "Halaman dengan link tanpa ?s=: $missing"

echo
echo "=================================================================="
echo "D. Tombol kontak menuju sales aktif, footer tetap dealer pusat"
echo "=================================================================="
echo "-- WA di halaman produk (harus 6289616880688 = sales) --"
curl -s --max-time 8 "$BASE/product/stargazer?s=$SLUG" | grep -oE 'wa\.me/[0-9]+' | sort -u
echo "-- WA di beranda (harus 6289616880688 = sales) --"
curl -s --max-time 8 "$BASE/?s=$SLUG" | grep -oE 'wa\.me/[0-9]+' | sort -u
echo "-- footer pada halaman mana pun TIDAK boleh memakai nomor sales --"
curl -s --max-time 8 "$BASE/?s=$SLUG" | grep -A3 -i "<footer" | grep -oE 'wa\.me/[0-9]+' | sort -u || echo "   (footer tanpa wa.me — sesuai keputusan)"

echo
echo "=================================================================="
echo "RINGKASAN: A gagal=$fail | B link mati=$dead | C halaman tanpa ?s=$missing"
echo "=================================================================="
