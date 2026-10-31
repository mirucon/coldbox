# Retired social links (2026-10-31)

The owner explicitly requested removal of Skype after noticing it in the design
preview. Removed its built-in profile option, frontend output and dedicated
widget styles. Existing saved values are left alone; the theme no longer reads
them as a supported social profile. Other social links remain available.

Also removed unused theme CSS for Google+, Vine and Pocket, including the old
Pocket Customizer selector. These no longer had built-in controls or frontend
features; this cleanup adds no replacement integration. Historical changelogs
and dependency-owned Font Awesome glyphs are not active service integrations.

Evidence checked on this date:

- [Microsoft](https://support.microsoft.com/en-us/skype/skype-is-retiring-in-may-2025-what-you-need-to-know): Skype retired May 5, 2025.
- [Google](https://workspace.google.com/blog/product-announcements/what-you-need-to-know-about-the-sunset-of-consumer-google-plus-on-april-second): consumer Google+ shut down April 2, 2019.
- [X's Vine archive FAQ](https://help.x.com/es/using-x/vine-faqs): only remaining individual archived URLs may be available; no current social-profile feature is restored.
- [Mozilla](https://blog.mozilla.org/en/mozilla/building-whats-next/): Pocket shut down July 8, 2025. Add-on functionality was already removed.
- [Foursquare](https://foursquare.com/city-guide-sunset/): City Guide app and web ended, but Foursquare Swarm continues. The existing generic URL field does not call City Guide APIs or force a City Guide URL, so it was not treated as a wholly discontinued provider.

Validation: package build and PHP syntax passed. In local WordPress with an
existing nonempty saved Skype setting, the built-in service registry and
Customizer control omitted Skype; frontend social markup omitted it while
Twitter still rendered. The registry contains 21 remaining entries. Browser
captures of the author, sidebar and footer show no Skype link.

New-tab indicator designs were reviewed separately as disposable local
previews. No new indicator design was implemented or published in this change.
Pre-existing uncommitted new-window-arrow removals were excluded from the commit.
