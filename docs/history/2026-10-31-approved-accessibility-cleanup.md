# Approved remaining accessibility cleanup

The owner approved the five remaining proposals after selecting form/navigation
option B on 2026-10-31. This supersedes the pending status recorded earlier in
`2026-10-31-form-navigation-selection.md`; it does not authorize publication.

Implemented scope:

- Replace the added thick white focus shadows with 2px outlines, using white on
  the existing dark footer/search/navigation surfaces. Preserve original shadows.
- Use #747474 for comment metadata/reply links and white alpha .46 for the search
  underline. Exclude that search field from the generic input-border rule so its
  own normal, hover and focus colors take effect.
- Preserve social-name tooltip styling, restore abbreviation tooltips, and add
  focus, Escape and pointer persistence. Keep native titles without JavaScript;
  avoid duplicate spoken social names and keep long descriptions within the
  viewport and above their abbreviation.
- Remove the unnecessary global category-link minimum height and social-tile
  minimum width. No optional target-size spacing was added.
- Scope widget underlines to paragraph links, correct the site/fallback-related
  heading structure, use WordPress's translated Posts navigation label, enable
  HTML5 navigation widgets and strengthen screen-reader-only clipping. Preserve
  title letter spacing and the fallback heading's existing font size.

Form/navigation B and the approved social palette/markers remain in effect.
The five previously accepted white-marker contrast shortfalls remain recorded
in `2026-10-31-social-notices.md`; this is not a claim of review certification.

Local verification used the built theme in real WordPress:

- PHP integration: 9 tests, 41 assertions passed.
- Initial full Chromium/Firefox/mobile WebKit run: 81 passed, 5 intentionally
  skipped, one Firefox failure. The failure exposed a pre-existing race: resize
  could invoke asynchronously loaded Masonry before it was available.
- Added a small readiness guard without changing script order; the existing load
  handler still lays out widgets when the library arrives. A regression delays
  the actual script, resizes before load, then verifies layout after load.
  Relevant browser tests: 25 passed, 2 intentionally skipped across three engines.
- Rendered 320/390/1280px views: no horizontal overflow; keyboard focus and
  tooltips work. Also checked native-title fallback without JS, long-description
  wrapping and unchanged typography after the fallback heading-level change.

Final clean-runner matrix verification is dispatched for the resulting source
commit. Local screenshots and Argon visual review are kept outside the package
under `.coldbox-work/a11y-resume-20261031/remaining-implemented/`.
No WordPress.org upload, release tag or dist-branch update is authorized here.
