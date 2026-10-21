# Maintenance

## Scope and support

The current cleanup retires AMP, Universal Analytics, Pocket and share counts.
Normal article display, settings, share links, OGP, verification tags and Ads
extension hooks remain. Old Coldbox `?amp=1` links redirect to ordinary pages.
Unrelated AMP plugins' `/amp/` paths are not intercepted. Saved retired settings
are left in the database; no user data migration or deletion is required.

Target WP 7.0/7.1 patches, PHP 7.4–8.5; latest two Chrome/Edge/Firefox/Safari,
including iOS Safari. IE and Opera Mini are excluded. CI checks representative
PHP versions and Chromium/Firefox/WebKit engines, not every device/version.

## Build and test

Use Node from `.nvmrc`, Composer, native PHP and MySQL/MariaDB.

```sh
npm ci && npm run build
composer install
# Create disposable databases named coldbox_test and coldbox_browser first.
# Defaults: loopback DB, user coldbox, password coldbox-test. Override with
# DB_HOST, DB_USER and DB_PASSWORD; never point these tests at a production DB.
export COLDBOX_THEME_DIR=/absolute/path/to/coldbox/dist
export COLDBOX_ADDON_DIR=/absolute/path/to/coldbox-addon/dist
WP_VERSION=7.1 bash tests/install.sh
WP_VERSION=7.1 composer test
```

The install script resolves the latest published patch in the chosen WP series.
PHPUnit runs against WordPress's official test bootstrap with a real database.
The companion package path makes local integration checks possible without
publishing either package. CI builds both public source repositories together.

Browser tests live in the theme. After installing its native runtime:

```sh
npx playwright install chromium firefox webkit
bash tests/browser-install.sh
# Run from the theme checkout; point COLDBOX_TEST_RUNTIME to another runtime if needed.
php -S 127.0.0.1:8874 -t .test-runtime/wordpress tests/router.php
# In a second terminal:
npm run test:browser
```

Only `dist/` is an installable package. Tests, node_modules, vendor and runtime
files are excluded. The theme uses editable plain CSS in `styles/`; it retains
the previous cascade order, asset names and class names. Feedly and Hatena use
the same bundled SVG shapes instead of a generated font. esbuild only bundles
and minifies; no Sass, Stylus, Babel, Webpack or webfont generator is required.

## Translation and publication

Extract a POT only when needed with `npm run pot` (official WP-CLI i18n command).
Compare gettext keys before editing wording. Existing language packs remain
usable for unchanged msgids, domains and contexts. Removed feature descriptions
do not require replacement translations. Distribution does not need a fresh POT
to load WordPress.org language packs.

Source cleanup does not authorize publication: do not change dist branches,
upload to WordPress.org or create a release. Version numbers remain at the last
release until publication is separately approved. After publication the owner
wants the agent to update and submit translations for currently supported locales;
that is a separate follow-up, not a new standing maintenance service.
