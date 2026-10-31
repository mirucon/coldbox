# Maintenance

## Runtime behavior and support

AMP, Universal Analytics, Pocket and share counts are not provided.
Normal article display, settings, share links, OGP, verification tags and Ads
extension hooks remain. Old Coldbox `?amp=1` links redirect to ordinary pages.
Unrelated AMP plugins' `/amp/` paths are not intercepted. Saved retired settings
are left in the database; no user data migration or deletion is required.

Requires WordPress 5.2+ and PHP 7.4+. The minimum WordPress version reflects
runtime API requirements, independently of the CI matrix. Browser targets are
the latest two Chrome/Edge/Firefox/Safari releases, including iOS Safari; IE and
Opera Mini are excluded. CI checks WP 7.0/7.1 patches with representative PHP
versions from 7.4–8.5, using desktop Chromium and mobile WebKit in each configuration.
Firefox is also checked on WP 7.1 / PHP 8.3. These are representative engines,
not certification of every device/version. CI retains layout screenshots for
seven days alongside failure traces.

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

TGMPA supplies the optional Add-on recommendation and installer in the admin area.
The bundled 2.6.1 copy retains Coldbox's translation domain and includes the
upstream completion-message fix for WordPress 4.8+: WordPress supplies the details
control, so TGMPA must not append a second sprintf placeholder. Keep the recommendation
dismissible and activation manual. The About page also links to this installer.

The About page includes review links, historical upgrade notices and the full
changelog. Edit `CHANGELOG.md`; the build generates `assets/html/CHANGELOG.html`
for the admin page and package. Marked is a build-only dependency, not runtime JS.

## Translation and publication

Extract a POT only when needed with `npm run pot` (official WP-CLI i18n command).
Compare gettext keys before editing wording. Existing language packs remain
usable for unchanged msgids, domains and contexts. Removed feature descriptions
do not require replacement translations. Distribution does not need a fresh POT
to load WordPress.org language packs.

Publication is a separate operation from source maintenance. After explicit
release authorization, choose release versions, build the installable packages
and verify their metadata before updating a dist branch or WordPress.org. CI
artifacts are candidates, not published releases.

See `docs/history/2026-10-21-upkeep.md` for the bounded cleanup decisions and
the deferred translation submission follow-up.

## CI cadence

Local development uses checks appropriate to the change. Ordinary source and
documentation pushes do not start the compatibility matrix. Non-documentation
PRs, including dependency PRs, and CI-workflow changes still run it automatically.
CHANGELOG.md and package content are not treated as ignored documentation.

For final clean-runner verification use `gh workflow run ci.yml --ref BRANCH`
(the repository's default branch), then inspect the run's resolved head SHA and
all four matrix jobs. Dispatch once per completed candidate when this coverage
is needed, never for every checkpoint or a documentation-only follow-up.
Before an explicitly authorized release, require full matrix success for that
exact candidate and verify the companion revision used in integration tests.
Reuse that run's built package; do not rerun unchanged tests just to record the
result. Source-only CI never grants WordPress.org, tag or dist-branch publication
authorization. PR concurrency still cancels obsolete runs on the same PR/ref.
