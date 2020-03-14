=== Coldbox ===
Contributors: @mirucon
Requires at least: 5.0
Tested up to: WordPress 5.3
Requires PHP: 5.2.4
Version: 1.8.4
License: GPL v2.0 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Tags: accessibility-ready, blog, one-column, two-columns, right-sidebar, left-sidebar, grid-layout, translation-ready, flexible-header, custom-background, custom-header, custom-colors, custom-menu, featured-images, post-formats, sticky-post, theme-options, editor-style, threaded-comments, custom-logo

== Description ==
A beautiful blog-focused WordPress theme - Coldbox. It helps increase site traffic from Google and any social networks. It provides you with easy to customize, lightweight, SEO friendly, quick load, and so much more! This theme is fully laid out with the flexbox module so that it is compatible with any screen sizes.

See the demo: https://coldbox.miruc.co/demo/
To get official child theme, visit https://coldbox.miruc.co/

The theme is available on GitHub: https://github.com/mirucon/coldbox

To get started, see the "About Coldbox" page from the "Appearance" menu after installed the theme.

= Add-On Plugin =

The official Add-on Plugin is now available. Download it from the WP.org plugin repository! [https://wordpress.org/plugins/coldbox-addon/](https://wordpress.org/plugins/coldbox-addon/)

The latest version has the following features. We highly recommend that you always use the plugin with the theme!

* Automatic AMP pages generation
* Social share buttons
* Google Analytics integration
* Automatic Open Graph tag output

= Author information =
The Coldbox theme is designed and created by mirucon
WordPress.org Profile: https://profiles.wordpress.org/mirucon/
Twitter: @mirucons
Email: i@miruc.co

== Copyright ==
Coldbox WordPress Theme, Copyright 2018 Toshihiro Kanai.
The Coldbox theme is distributed under the terms of GNU GPL.

FontAwesome License
Font License - SIL OFL 1.1
Code License - MIT License
URL: http://fontawesome.io/license/
Created by Dave Gandy

IcoMoon License
License - GPL / CC BY 4.0
URL: https://icomoon.io/#icons-icomoon
Created by Keyamoon

Highlight.js License
License - BSD 3-clause License
URL: https://highlightjs.org/
Created by @highlightjs

PlaceFolder Camera Icon License
License - MIT License
URL: http://ionicons.com/
Created by @benjsperry

TGM Plugin Activation License
License - GPL v2 or later
URL: http://tgmpluginactivation.com/

CSS minifying function
License - GPL
URL: https://github.com/GaryJones/Simple-PHP-CSS-Minification/blob/master/minify.php
Created by Gary Jones

Smooth Scroll behavior polyfill
License - MIT
URL: https://github.com/iamdustan/smoothscroll
Created by Dustan Kasten and Jeremias Menichelli

All the photos used in the screenshots are all licensed under CC0.
* https://pixabay.com/en/computer-computer-code-screen-1209641/
* https://unsplash.com/photos/Azli_kcxRNE
* https://unsplash.com/photos/z06kuSSlIeY
* https://pixabay.com/en/pizza-basil-garlic-crust-sauce-1209748/

== Changelog ==

= 1.8.4 =

* fix: Do not apply tablet/PC grid column setting to mobile

= 1.8.3 =

* fix: Do not enforce 100% grid width on mobile

= 1.8.2 =

* fix: Apply grid width for classes named post/page on mobile

= 1.8.1 =

* fix: Make the heading text for "Comments" translatable
* fix: Apply grid width for classes named post/page

= 1.8.0 =

* Theme now requires WP version 5.0 or higher
* fix: babel-polyfill is conflicting with Gutenberg or some other plugins

= 1.7.3 =

* feat: Don't open all the sub-menus when focused on menu item
* fix: Menu items are not clickable when having more than two sub-menus in the same parent menu
* And small bug fixes

= 1.7.2 =

* fix: Center the feature photo in posts by default
* fix: Menu item is not closing when holding with mouse
* fix: Delete Google Plus things
* And small bug fixes

= 1.7.1 =

* Upgrade Slack icon to their new logo
* feat: Implement new social link for Telegram
* fix: JS notice when header menu doesn't exist
* And small bug fixes and performance improvements

= 1.7.0 =

* Added: New option to use custom font size for the site title
* Fixed: Alignment of footer sidebars
* Fixed: Alignment of social links widget on footer sidebars
* Updated: Font Awesome version 5.2 from 4
* Improved: Remove Icomoon icon fonts which included unused icons and replace with Simple Icons
* Improved: Replace icons in pseudo elements with span elements
* Improved: Use Webpack to compile theme stylesheet
* Improved: Bundle theme stylesheet, Font Awesome and Simple Icons into one CSS file for better performance

= 1.6.4 =

* Added: Footer widget areas
* Fixed: The user was able to navigate outside of modal even when it's active
* Fixed: Search form issue
* Fixed: JavaScript notice when no header menu present
* Fixed: Better HTML elements

= 1.6.3 =

* Fixed: Non-keyboard users friendly menu on mobile

= 1.6.2 =

* Added: New customizer option to change header menu color for mobile
* Added: Customizer validator to prevent PHP warnings
* Fixed: Aria-hidden attribute of nav toggle
* Fixed: Smooth scroll script intercepts any link with inline target
* Removed: Customizer option to use un-minified files

= 1.6.1 =

* Added: function to prevent the users from navigating outside of the search modal
* Fixed: the menu toggle is not working on mobile
* Fixed: HTML outline
* Improved: Not to use alt attribute inside of block link

= 1.6.0 =

* Added: Webpack modules
* Added: New customizer option to only hide the site title/description
* Improved: Replaced all jQuery codes with native JavaScript
* Improved: Accessibility items
  * Added: Corresponding form labels
  * Added: Skip to content link
  * Added: Close menu link at the end of menu on mobile
  * Added: Corresponding ARIA landmark
  * Added: Fallback text for icons
  * Fixed: HTML outline
  * Improved: Color Contrasts
  * Improved: Styling on :focus
* Improved: Redesign back to top icon
* Improved: Archive page design when no results found
* And includes many small bug fixes and improvements

= 1.5.5 =

* Fixed: Translation issues
* Fixed: Version number in the admin bar has been updated

= 1.5.4 =

* Added: You can now show post thumbnail image before the content on single pages
* Changed: Default font size - 15px for mobile and 16px for desktop
* Fixed: Some compatibilities with the newly released Coldbox Ads Extension plugin
* And includes some bug fixes and performance improvements

= 1.5.3 =

* Added: Link to privacy policy page in footer
* Added: New customizer option to choose whether it outputs the privacy policy page link
* Fixed: Feedly subscription URL

= 1.5.2 =

* Added: New hook for logo images
* Fixed: A few issues happened with the addon plugin

= 1.5.1 =

* Added: Action hooks can be used for putting some content in the single content
* Updated: About Coldbox page

= 1.5.0 =

* Added: "About Coldbox" page
* Added: New customizer option to adjust the logo width
* Added: New customizer option to select whether use narrower padding when scrolling
* Added: New customizer option to change the header menu background color for mobile
* Added: New customizer option to select whether use concatenated JS files
* Fixed: Post's published date was not showing when the published and modified date isn't same
* Fixed: Site logo was being shown too big
* Fixed: Flicker of the search modal
* Improved: flex-width logo is now supported
* Updated: Moved the customizer option "Logo" to the "Coldbox: Header Settings" from "Site Identity"
* Updated: Default font family value
* Updated: Template Hierarchy; img/ and fonts/ directories are now at assets/ folder, and czr/ directory is now at parts/ folder.
* And other small bug fixes and performance improvements.

= 1.4.1 =

* Fixed: Default option of a customizer option was not working properly
* Fixed: Load non-minified CSS/JS when script debug is on
* Updated: No more SNS Count Cache plugin recommendation

= 1.4.0 =

* Improved: Start using a bit modern functions
* Changed: Template hierarchy; all the CSS/JS files are now at assets folder
* Fixed: Minor security bug

*See CHANGELOG.md to see full changelog*

