#!/usr/bin/env bash
set -euo pipefail
cd "$(dirname "$0")/.."
RUNTIME="${COLDBOX_TEST_RUNTIME:-$PWD/.test-runtime}"
URL="${COLDBOX_TEST_URL:-http://127.0.0.1:8874}"
WP=(php "$RUNTIME/wp-cli.phar" --path="$RUNTIME/wordpress" --url="$URL")
if [ ! -f "$RUNTIME/wordpress/wp-config.php" ]; then
  "${WP[@]}" config create --dbname=coldbox_browser --dbuser="${DB_USER:-coldbox}" --dbpass="${DB_PASSWORD:-coldbox-test}" --dbhost="${DB_HOST:-127.0.0.1}" --skip-check
fi
if ! "${WP[@]}" core is-installed; then
  "${WP[@]}" core install --url="$URL" --title='Coldbox verification' --admin_user=coldbox-test --admin_password=coldbox-local-test --admin_email=test@example.org --skip-email
fi
"${WP[@]}" option update home "$URL"
"${WP[@]}" option update siteurl "$URL"
"${WP[@]}" config set WP_DEBUG true --raw
"${WP[@]}" config set WP_DEBUG_LOG true --raw
"${WP[@]}" config set WP_DEBUG_DISPLAY false --raw
"${WP[@]}" config set DISABLE_WP_CRON true --raw
"${WP[@]}" theme activate coldbox
if [ -f "$RUNTIME/wordpress/wp-content/plugins/coldbox-addon/coldbox-addon.php" ]; then
  "${WP[@]}" plugin activate coldbox-addon
fi
"${WP[@]}" eval-file tests/browser-fixture.php
