# Maintenance scope

Preserve existing display, saved settings, PHP compatibility and optional AMP/ads integrations.
Small fixes and verification are welcome; do not redesign or introduce a maintenance service.
Do not add advertising, sales prompts, invitations to email the author or promises of support.

## Validation

Use the Node version in .nvmrc and Yarn 1.22.22. Install with the frozen lockfile,
build the dist package, then `npm ci --prefix tests --ignore-scripts` and
`npm test --prefix tests`. The smoke runner uses disposable local WordPress,
checks actual pages/assets and the PHP debug log, and shuts itself down.
WP_VERSION and PHP_VERSION select versions; CI covers latest/8.3, latest/8.5
and 6.2/7.4. This is not a full browser, MySQL or minimum-version certification.
Test fixtures must never be included in dist. The tests-only qs override selects
a compatible patched parser while Playground pins an older Express dependency.

## Publication and notifications

CI is read-only and retains temporary candidate artifacts. It must not update
GitHub dist, publish releases, deploy a website or upload to WordPress.org.
WordPress.org publication requires explicit owner approval. Do not bump a version
or Tested up to solely to make the directory treat the project as maintained.
Keep the old published dist branch intact until a release is explicitly requested.

Routine source maintenance is authorized for this repository. Preserve unrelated
work. Do not request the owner's review merely as a notification, and remove the
AI-created maintenance PR's individual subscription before finishing. Do not mute
human conversations or alter repository-wide subscriptions.
