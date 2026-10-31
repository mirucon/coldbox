# Selected comment-field and post-navigation appearance

The owner selected option B for both items on 2026-10-31:

- Comment fields retain light `#ddd` top/side borders and use `#8e8e8e` only
  on the bottom edge (3.03:1 against the existing `#f6f6f6` panel). Fill colors,
  dimensions and other controls are unchanged.
- Previous/next article links retain the original photo opacity and hover
  behavior. The previously added dark overlay is removed. A 1px `#333` text
  halo and the matching subtle arrow shadows implement the reviewed B preview.

The built package was loaded into local WordPress. All 50 captures matched the
approved previews pixel-for-pixel: two comment-form widths and 48 navigation
combinations (six images, Japanese/English short/long titles, two widths).
An initial mobile capture mismatch was a floating back-to-top button caused by
different scroll history; matching the original capture setup resolved it without
changing product behavior. Twelve Chromium/WebKit width/state combinations
confirmed the selected boundaries, photo opacity, absence of the overlay and
visible keyboard focus. Existing browser accessibility regressions passed 22
tests with two platform-specific skips in Linux Chromium/WebKit. Build passed.

Other disclosed proposals remain unapproved and unimplemented: global focus
styling, metadata/search-line tuning, tooltip repair, spacing and structural
markup changes. Selecting these two visual options did not approve that batch.
The social decisions recorded separately remain in effect. This is source
maintenance only; WordPress.org publication and dist-branch updates remain pending.
