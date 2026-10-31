# Footer credit underline correction

The October 29 design brief explicitly deferred blanket underlining of footer
credits. The October 28 `.copyright a` rule nevertheless remained in the later
cleanup, whose generic description of prose links did not clearly disclose this.
The owner identified the inconsistency on October 31.

Remove `.copyright a` and its hover selector from the added underline rules.
Keep paragraph links in text/block widgets underlined and keep keyboard focus
indicators. This restores the previously stated design decision; it does not
claim that every possible custom credit paragraph satisfies the link guideline.
The guideline distinguishes links in prose from navigation-like contexts, rather
than requiring blanket styling of every footer link.

The built package was checked in the local WordPress preview using Chromium,
Firefox and WebKit. Normal and hovered credit links have no underline; keyboard
focus remains visible and text-widget paragraph links remain underlined.
Evidence: `.coldbox-work/prepublish-20261031/footer-results.json` and screenshots
in the sibling workspace (not distributed). WordPress.org is not published.
