# TGMPA restoration and removal audit, 2026-10-29

The owner requested restoration of TGMPA, necessary fixes and real installation
checks, and an audit of other removed features or discovery paths. Accessibility
design discussion is deferred until this work is complete. Publication, release
tags and updates to the dist branch remain unauthorized.

## Restored

- The two original `parts/tgm/` files and the theme loader; same Coldbox Addon
  recommendation, minimum version 1.2.0, dismissible notice, no automatic activation.
- About Coldbox's Add-on section and installation link. Retired AMP and Universal
  Analytics features are omitted from its feature list; surviving gettext keys
  and theme admin styling are retained. The link respects the installer's capability.
- TGMPA license attribution and inclusion in the installable package.

The old library appends a second sprintf placeholder to the installation success
message, but modern WordPress passes only the plugin title. This produces
ArgumentCountError on PHP 8. The upstream develop fix appends the old details link
only for WordPress before 4.8; the bundled copy now does the same. The original
Coldbox translation domain and strings are preserved.

Source: https://github.com/TGMPA/TGM-Plugin-Activation/blob/develop/class-tgm-plugin-activation.php
Related report: https://github.com/TGMPA/TGM-Plugin-Activation/issues/824

This problem was established on October 29; it was not the recorded rationale for
the October 21 deletion. That deletion was grouped under simplification and
promotion cleanup without distinguishing useful Add-on discovery from Ads sales.
The earlier upkeep notes' description of TGMPA as retired is superseded here.

## Removal audit

Compared all source changes from immediately before this upkeep (theme 4cad8db5^,
Add-on 00e74eb^) to the current source, including runtime PHP, registration hooks,
Customizer settings, JS, package contents and documentation links.

- Add-on discovery: both TGMPA and the About section were removed together.
  Both restored. The readme's WordPress.org Add-on link had remained present.
- Ads extension promotion: admin notices, About sales copy, Customizer sales copy
  and the Gumroad donate link were removed. This matches the explicit request.
  Ordinary Ads integration hooks were retained.
- Support invitations: About's Need Help/email/forum/contribution invitation and
  README email were removed. The private vulnerability reporting path remains.
- Review solicitation: About's Rate this theme section and WP.org review link
  were also removed without a separate decision. Not required by Ads/support
  removal. Still absent; recommend keeping this solicitation absent for quiet upkeep.
- Old upgrade guidance: About's version-specific notices (1.5.0 through 1.9.0),
  the admin-bar Upgrade Notices shortcut and block-editor demo link were removed.
  Inline HTML changelog became a link to the packaged CHANGELOG.md. These are
  presentation/discovery changes, not loss of the changelog source. They were not
  specifically requested; recommend retaining the simpler current presentation.
- PHP <7.2 warning was removed; those runtimes are below the agreed PHP 7.4 minimum.
- Add-on AMP, Universal Analytics, Pocket and share-count integration and their
  settings/helpers were retired as discussed. Old AMP query links redirect;
  stored retired values were not deleted. Other share services, shortcode, OGP,
  verification and opt-in jQuery deregistration remain.
- Theme Customizer settings, menus, widgets, thumbnail settings, child-theme and
  normal Ads hooks were not removed. JS changes fix interactions; removal of the
  smooth-scroll polyfill does not remove native scrolling in supported browsers.
- Webpack/Sass/Stylus/font generation, old lint/build tooling and automatic release
  workflows were replaced/removed. These are developer procedures, not end-user
  features. Native WordPress/PHPUnit and browser checks remain; publication is manual.
- Accessibility visual changes are a separate unresolved review, not silently
  treated as approved removals. This restoration does not settle that review.

## Verification

Old completion rendering reproduced ArgumentCountError on WP 7.1.3/PHP 8.1.2.
After the fix, native WordPress/PHPUnit passed 9 tests / 36 assertions, including
both completion-message modes and optional/dismissible Add-on configuration.

A separate local WordPress and database were created for destructive plugin-state
tests. The owner's preview site data/settings were not reset. Browser checks
installed public Add-on 1.2.5 via TGMPA's bulk flow, confirmed it remained inactive,
activated it manually and checked the active About state and frontend. The bulk
completion screen succeeded without the original fatal error.

Further browser checks passed: individual installation link, individual and bulk
activation, persisted dismissal followed by the About installation link, and
editor-role denial (HTTP 403). The individual-install test initially matched the
lowercase word "successfully" case-sensitively; WordPress prints "Successfully".
Reading the actual completion output and repeating the full flow confirmed success.
No new PHP diagnostics occurred during HTTP tests; the isolated setup logged one
WordPress CLI HTTP_HOST warning during core installation, before browser testing.

CI run 40862943121 on commit 004733e4 passed all four jobs: WP 7.0/PHP 7.4,
WP 7.1/PHP 7.4, WP 7.1/PHP 8.3 and WP 7.1/PHP 8.5. Each includes PHP syntax,
native WordPress regression tests and existing browser checks. The explicit TGMPA
installer clicks were exercised locally on WP 7.1.3/PHP 8.1, not in every CI job.
https://github.com/mirucon/coldbox/actions/runs/40862943121
