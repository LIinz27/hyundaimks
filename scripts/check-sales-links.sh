#!/usr/bin/env bash
# check-sales-links.sh
#
# Audit every Blade view for internal links / forms / route helpers that do NOT
# go through sales_route() / sales_url() (or the sales.show route, which is
# context-free by design).
#
# Exits 0 when clean, 1 when violations are found.

set -u

VIEWS_DIR="resources/views"
FAIL=0

flag() {
    echo "$1"
    FAIL=1
}

echo "== 1. Internal <a href=\"/...\"> or <form action=\"/...\"> hardcoded =="
# Internal hardcoded paths (not external, not #, not mailto:, not tel:)
matches=$(grep -rnE '<(a|form)[^>]+(href|action)="/' "$VIEWS_DIR" --include='*.blade.php' \
    | grep -v 'sales_route\|sales_url' || true)
if [ -n "$matches" ]; then
    flag "$matches"
else
    echo "OK - none found"
fi

echo
echo "== 2. route() / url() helpers not wrapped by sales_route/sales_url =="
# route('...') that is not sales_route('...') and not the context-free sales.show
matches=$(grep -rnE '\b(route|url)\(' "$VIEWS_DIR" --include='*.blade.php' \
    | grep -v 'sales_route(\|sales_url(\|route(.sales.show\|Storage::disk' \
    | grep -v 'resources/views/sales/show.blade.php' || true)
if [ -n "$matches" ]; then
    flag "$matches"
else
    echo "OK - none found"
fi

echo
echo "== 3. Contact buttons pointing away from the active sales =="
# wa.me / whatsapp links that are NOT active_sales() driven and NOT the footer
# (footer intentionally keeps central dealer contact per spec §1.2)
matches=$(grep -rniE 'wa\.me|whatsapplink' "$VIEWS_DIR" --include='*.blade.php' \
    | grep -v 'resources/views/footer.blade.php' \
    | grep -v 'active_sales()\|\$sales->whatsappLink()\|\$waLink' || true)
if [ -n "$matches" ]; then
    flag "$matches"
else
    echo "OK - none found"
fi

echo
echo "== 4. Footer must keep central contact (sanity check) =="
if grep -q "config('site.contact_whatsapp')" "$VIEWS_DIR/footer.blade.php" \
   && grep -q 'wa.me/{{ $wa }}' "$VIEWS_DIR/footer.blade.php"; then
    echo "OK - footer uses config/site.php central contact"
else
    flag "footer.blade.php no longer uses the central dealer contact!"
fi

echo
if [ "$FAIL" -eq 0 ]; then
    echo "RESULT: CLEAN - all internal links preserve the sales context."
else
    echo "RESULT: VIOLATIONS FOUND - fix the items above."
fi
exit "$FAIL"
