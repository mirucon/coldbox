# Social notices: selected appearance and verification

The owner selected Slack aubergine `#4a154b`, white new-tab notices on colored
social/share buttons, muted gray `#b8b9b2` notices in the footer, and 2px more
right clearance for share notices (5.5px total). Bell background `#bd8c04`
keeps its yellow identity while reaching 3.04:1 against white. Hatena's hover
opacity is 0.81, the minimal adjustment needed to reach 3.01:1.

The former blanket darkening of social backgrounds was replaced by the existing
palette shown in the approved previews. The small SVG notices do not change
button or main-logo dimensions. The theme emits a notice only for an actual
new-tab link; the Add-on preserves its existing new-tab behavior. Service names
remain accessible independently of decorative glyphs. Custom footer backgrounds
also supply the notice's backing color.

White notices on Twitter/Feedly profile buttons and Twitter/LINE/Feedly share
buttons remain below 3:1, with a measured minimum of 1.82:1 on hover. The owner
explicitly accepted this appearance on 2026-10-31 and requested reconsideration
if WordPress.org review objects. This decision does not claim an exemption,
successful review, or conformance of the whole theme. Do not reopen the same
color choice merely because the recorded ratios are below 3:1.

Verification used the built packages in local WordPress: desktop/mobile widths
1280/390, Chromium and WebKit normal/hover/focus states, and link-name/layout
regression tests in Chromium, Firefox (WSL), and WebKit. PHP rendering checks
confirmed 21 new-tab notices with the Add-on target filter, zero notices without
that filter, and custom-footer-color propagation. Slack measured 14:1 after the
selected color was applied. Build and PHP syntax checks passed.

After the final Slack update, the existing accessibility and social-link suites
passed 12 tests each in Chromium and Linux WebKit (one platform-specific test
skipped in each). Windows WebKit skipped links during Tab navigation in seven
tests; an independent, theme-free HTML page reproduced this behavior, while
Linux WebKit traversed the same links normally. No theme workaround or disabled
assertion was introduced for that platform difference.

Other accessibility design proposals remain separate, including comment-input
boundaries, post-navigation photos, focus appearance and tooltip behavior.
No WordPress.org upload, release tag, or dist-branch update is authorized yet.
