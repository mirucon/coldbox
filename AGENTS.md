# Maintenance scope

Keep Coldbox useful for existing occasional users with little owner involvement.
This is bounded upkeep, not a growth effort or a commitment to preserve every
legacy feature. Preserve unrelated work and inspect evidence before editing.

- AMP rendering, Universal Analytics, Pocket, share-count integration and TGMPA
  are retired. Keep old `?amp=1` article URLs working via ordinary-page redirects.
- Keep normal Ads extension hooks, saved settings and opt-in jQuery deregistration.
  No Ads promotion, support solicitations or promises of ongoing maintenance.
- Preserve PHP function names, HTML/CSS/JS classes and script ordering where a
  change has little practical benefit; these are potential customization points.
- Current verification targets: WP 7.0/7.1 patches and PHP 7.4–8.5, with CI on
  7.4/8.3/8.5. Browsers: latest two Chrome, Edge, Firefox and Safari releases,
  including iOS Safari. IE and Opera Mini are outside scope. This is not a
  promise to add versions automatically without another maintenance decision.
- Build tools may change. Use plain CSS and the small esbuild pipeline in the
  theme; the addon has no production build dependencies. Do not add generic
  frameworks, dashboards, scheduled work or scanners without a specific benefit.
- Keep existing gettext msgids/domains/context unchanged when meaning is unchanged.
  Remove obsolete paragraphs/controls as a whole. Accept limited fallback English
  for necessary new meaning; never reuse a translation with the wrong meaning.

## Validation and ownership

See MAINTENANCE.md for repeatable commands. `composer test` runs native PHP with
WordPress's PHPUnit framework and MySQL/MariaDB. Browser tests run in Playwright.
Do not replace PHP tests with an npm command or source-text assertions. Test
observable behavior at the relevant boundary; avoid exhaustive feature matrices.
Test fixtures, dependencies, credentials and runtime files must not ship in dist.

Routine source maintenance is authorized. Direct commits on the default branch
are sufficient; PRs are optional. Preserve recoverable history and unrelated work.
Do not assign/request owner review as a notification. If an AI maintenance PR is
touched, remove its individual subscription at the end; preserve human subscriptions.

## Publication and deferred translation work

Do not publish to WordPress.org, update dist branches, create releases or deploy
websites without explicit approval. CI creates temporary candidate artifacts only.
Do not bump release versions just to signal maintenance. Existing release metadata
does not mean this source has been published.

After a separately approved publication, the owner wants the agent to revise the
currently supported translations and submit them on WordPress.org. That submission
is explicitly outside this cleanup. Verify available locales at that time; preserve
unchanged translation keys now and record the extraction comparison.
