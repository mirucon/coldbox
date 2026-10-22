# Working on Coldbox

Coldbox is a classic WordPress blog theme. Keep useful behavior for existing
sites with little owner involvement. Prefer changes with a concrete user or
maintenance benefit; age alone is not a reason to preserve or replace something.

## Editing

- PHP templates and `functions.php` implement the theme; `parts/czr/` owns
  Customizer settings, sanitization and generated styles. The optional
  [Coldbox Add-on](https://github.com/mirucon/coldbox-addon) owns share buttons
  and metadata. Check that integration when changing shared hooks or settings.
- Edit CSS in `styles/` and JavaScript in `assets/js/`. `bin/build.mjs` generates
  `assets/css/`, `assets/fonts/`, `assets/js/min/` and the installable `dist/`.
  Rebuild these outputs instead of editing them directly.
- Assess compatibility by user impact. Avoid gratuitous changes to saved option
  keys, PHP hooks/functions, CSS classes and asset ordering used by child themes
  or custom CSS. A worthwhile removal can be preferable to maintaining an old
  feature; account for existing content and URLs when making that decision.
- Preserve gettext msgids, domains and contexts when meaning is unchanged.
  If meaning changes, use accurate wording and account for translation fallback.

## Verification

Use [MAINTENANCE.md](MAINTENANCE.md) for setup, supported targets and commands.
`npm run build` produces the installable theme; `composer test` exercises PHP
against a real WordPress database; `npm run test:browser` checks browser behavior.

Choose checks for the affected behavior. For UI or setting changes, exercise the
actual control, save, reload and check the rendered result. For package changes,
test the built package in WordPress. Fix and recheck findings autonomously;
do not leave checks the agent can perform as an owner's release checklist.
Add regression coverage for meaningful failure modes, not assertions that merely
repeat source code. Keep disposable databases and runtime artifacts out of Git
and distribution packages.

## Source and releases

Direct commits on the default branch are sufficient; PRs are optional. Review
outgoing changes and preserve unrelated work. Source maintenance and release
publication are separate: WordPress.org uploads, release tags and `dist` branch
updates require explicit release authorization. See MAINTENANCE.md for packaging.

Keep this file as reusable working guidance. Build/run instructions belong in
MAINTENANCE.md; dated investigations and verification results belong in
`docs/history/`, not in the instructions loaded for every task.
