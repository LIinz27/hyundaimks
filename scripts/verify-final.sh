#!/usr/bin/env bash
# Verifikasi independen G5: matriks akses + sweep link + audit query.
# Milik orkestrator, untuk memeriksa klaim G5 secara terpisah.
set -u

BASE="${1:-http://127.0.0.1:8000}"
SLUG="rukman-fadli"

code() { curl -s -o /dev/null -w '%{http_code}' --max-time 8 "$1"; }

PAGES=(/ /pricelist /proses-kredit /simulasi-kredit /tes-drive /portofolio /kontak /product/stargazer)

echo "=================================================================="
echo "MATRIKS AKSES"
echo "=================================================================="
printf '%-22s %-9s %-9s %-9s\n' "HALAMAN" "TANPA" "?s=AKTIF" "?s=SALAH"
for p in "${PAGES[@]}"; do
  a=$(code "$BASE$p")
  b=$(code "$BASE$p?s=$SLUG")
  c=$(code "$BASE$p?s=tidak-ada-sama-sekali")
  printf '%-22s %-9s %-9s %-9s\n' "$p" "$a" "$b" "$c"
done
echo
printf '/admin                 %s (harus 302, bukan 404)\n' "$(code "$BASE/admin")"
printf '/admin/login           %s (harus 200)\n' "$(code "$BASE/admin/login")"
echo
echo "-- sales nonaktif --"
php artisan tinker --execute="
\$s=\App\Models\Sales::first(); \$s->is_active=false; \$s->save();" >/dev/null 2>&1
printf '  ?s=rukman-fadli (nonaktif): %s (harus 404)\n' "$(code "$BASE/?s=$SLUG")"
php artisan tinker --execute="
\$s=\App\Models\Sales::first(); \$s->is_active=true; \$s->save();" >/dev/null 2>&1
printf '  ?s=rukman-fadli (aktif lagi): %s (harus 200)\n' "$(code "$BASE/?s=$SLUG")"

echo
echo "=================================================================="
echo "SWEEP LINK: setiap href internal harus 200"
echo "=================================================================="
normalize() { sed -E "s#^https?://[^/]+##"; }
dead=0; total=0
for p in "${PAGES[@]}"; do
  links=$(curl -s --max-time 8 "$BASE$p?s=$SLUG" \
    | grep -oE 'href="[^"]+"' | sed 's/^href="//;s/"$//' \
    | grep -E '^(https?://)?/|^https?://[^/]+/' \
    | grep -vE '/(admin|storage|build|images)|\.(css|js|png|jpe?g|webp|svg|ico|woff2?)$' \
    | grep -E "^$BASE|^/" | normalize | sort -u)
  for l in $links; do
    total=$((total+1))
    c=$(code "$BASE$l")
    [ "$c" = "200" ] || { printf '  MATI: %-40s (%s) di %s\n' "$l" "$c" "$p"; dead=$((dead+1)); }
  done
done
echo "Total link diperiksa: $total | mati: $dead"

echo
echo "=================================================================="
echo "AUDIT QUERY"
echo "=================================================================="
php artisan tinker --execute="
use Illuminate\Support\Facades\DB;
\$app = require 'bootstrap/app.php';
\$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
foreach (['/?s=$SLUG', '/product/stargazer?s=$SLUG', '/pricelist?s=$SLUG'] as \$u) {
  \$log=[];
  DB::listen(function(\$q) use (&\$log){ \$log[]=\$q->sql; });
  \$res = app(Illuminate\Contracts\Http\Kernel::class)->handle(Illuminate\Http\Request::create(\$u,'GET'));
  echo str_pad(\$u, 34).' status='.\$res->getStatusCode().' query='.count(\$log).PHP_EOL;
  DB::connection()->flushQueryLog();
}
" 2>&1 | tail -4

echo
echo "=================================================================="
echo "KEBERSIHAN"
echo "=================================================================="
echo -n "inline style di view publik: "
grep -rl 'style="' resources/views/homepage resources/views/layouts resources/views/errors resources/views/pages 2>/dev/null | wc -l
echo -n "referensi kode mati: "
grep -rn "sales.show\|SalesPageController\|sales-card\|salesList" app resources routes config tests 2>/dev/null | grep -v graphify | wc -l
echo -n "img tanpa alt: "
grep -rhoE '<img [^>]*>' resources/views/ 2>/dev/null | grep -vc 'alt=' || echo 0
