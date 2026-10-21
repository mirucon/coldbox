#!/usr/bin/env bash
set -euo pipefail
cd "$(dirname "$0")/.."
ROOT="$PWD"
RUNTIME="$ROOT/.test-runtime"
mkdir -p "$RUNTIME"
WP_VERSION="${WP_VERSION:-7.1}"
DB_HOST="${DB_HOST:-127.0.0.1}"
DB_USER="${DB_USER:-coldbox}"
DB_PASSWORD="${DB_PASSWORD:-coldbox-test}"
# Resolve the latest published patch within the explicitly supported WP series.
curl -fsSL https://api.wordpress.org/core/stable-check/1.0/ -o "$RUNTIME/versions.json"
WP_RELEASE=$(php -r '$v=array_keys(json_decode(file_get_contents($argv[1]),true)); $v=array_filter($v,function($v)use($argv){return $v===$argv[2] || strpos($v,$argv[2].".")===0;}); usort($v,"version_compare"); echo end($v);' "$RUNTIME/versions.json" "$WP_VERSION")
test -n "$WP_RELEASE"
curl -fsSL "https://wordpress.org/wordpress-${WP_RELEASE}.tar.gz" | tar -xz -C "$RUNTIME"
curl -fsSL "https://github.com/WordPress/wordpress-develop/archive/refs/heads/${WP_VERSION}.tar.gz" | tar -xz -C "$RUNTIME"
curl -fsSL https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar -o "$RUNTIME/wp-cli.phar"
THEME_DIR="${COLDBOX_THEME_DIR:-$ROOT/dist}"
mkdir -p "$RUNTIME/wordpress/wp-content/themes/coldbox"
cp -R "$THEME_DIR/." "$RUNTIME/wordpress/wp-content/themes/coldbox/"
if [ -n "${COLDBOX_ADDON_DIR:-}" ]; then
  mkdir -p "$RUNTIME/wordpress/wp-content/plugins/coldbox-addon"
  cp -R "$COLDBOX_ADDON_DIR/." "$RUNTIME/wordpress/wp-content/plugins/coldbox-addon/"
fi
export RUNTIME DB_HOST DB_USER DB_PASSWORD
php <<'PHP'
<?php
$base = getenv('RUNTIME');
$config = "<?php\n";
foreach (['DB_NAME'=>'coldbox_test', 'DB_USER'=>getenv('DB_USER'), 'DB_PASSWORD'=>getenv('DB_PASSWORD'), 'DB_HOST'=>getenv('DB_HOST'), 'DB_CHARSET'=>'utf8', 'DB_COLLATE'=>'', 'WP_TESTS_DOMAIN'=>'example.org', 'WP_TESTS_EMAIL'=>'test@example.org', 'WP_TESTS_TITLE'=>'Coldbox tests', 'WP_PHP_BINARY'=>PHP_BINARY, 'ABSPATH'=>$base.'/wordpress/'] as $key=>$value) {
 $config .= 'define('.var_export($key,true).', '.var_export($value,true).");\n";
}
$config .= "define('WP_DEBUG', true);\n\$table_prefix = 'wptests_';\n";
file_put_contents($base.'/wp-tests-config.php',$config);
PHP
echo "Installed WordPress $WP_RELEASE and its native PHPUnit framework."
