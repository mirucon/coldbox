# Coldbox v1.6.3

[![Build Status](https://travis-ci.org/mirucon/coldbox.svg?branch=master)](https://travis-ci.org/mirucon/coldbox) [![FOSSA Status](https://app.fossa.io/api/projects/git%2Bgithub.com%2Fmirucon%2Fcoldbox.svg?type=shield)](https://app.fossa.io/projects/git%2Bgithub.com%2Fmirucon%2Fcoldbox?ref=badge_shield) [![License: GPL v2](https://img.shields.io/badge/License-GPL%20v2-blue.svg)](https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html)

![coldbox-screenshot](/screenshot.jpg)

A beautiful blog-focused WordPress theme - Coldbox. It helps increase site traffic from Google and SNS. It is easy to customize, lightweight, SEO friendly, and quicker load. This theme is fully laid out with the Flexbox module, that is, it is really flexible.

**Contributors**: [@mirucon](https://profiles.wordpress.org/mirucon/)  
**Version**: 1.6.3  
**Requires at least**: Version 4.7 or higher  
**Tested up to**: WordPress 4.9  
**Requires PHP**: 5.2.4  
**License**: GPL v2.0 or later  
**License URI**: http://www.gnu.org/licenses/gpl-2.0.html  
**Tags**: accessibility-ready, blog, one-column, two-columns, right-sidebar, left-sidebar, grid-layout, translation-ready, flexible-header, custom-background, custom-header, custom-colors, custom-menu, featured-images, post-formats, sticky-post, theme-options, editor-style, threaded-comments, custom-logo

See the demo: [https://coldbox.miruc.co/demo/](https://coldbox.miruc.co/demo/)

## Getting Started
If you switch from other theme to this theme, we recommend you to regenerate all of your thumbnails with the Regenerate Thumbnails plugin. It will create consistent sizes of your thumbnails, with the appropriate size for this theme.

If you start your WordPress life with this theme, then there's no need to regenerate thumbnails. The theme will automatically create the appropriate size of your thumbnail every time you set a new thumbnail image.

Then, go ahead to the Theme Customizer to customize the theme as you like. Sections whose name started with "Coldbox:" are the settings we have added for you to customize. Don't forget, there's also a section called Colors so you can customize some colors used in the theme.

See "About Coldbox" page after installing the theme :)

To get a bootstrap of child theme, visit the [Coldbox official site](https://coldbox.miruc.co/).

### Add-on Plugin
The official Add-on Plugin is now available. Download it from the WP.org plugin repository! [https://wordpress.org/plugins/coldbox-addon/](https://wordpress.org/plugins/coldbox-addon/)  

The latest version has the following features. We highly recommend that you always use the plugin with the theme!

* Automatic AMP pages generation
* Social share buttons
* Google Analytics integration
* Automatic Open Graph tag output

## Theme Author information
The Coldbox theme is designed and created by mirucon  
WordPress.org Profile: [https://profiles.wordpress.org/mirucon/](https://profiles.wordpress.org/mirucon/)  
Twitter: [@mirucons](https://twitter.com/@mirucons)  
Email: i@miruc.co

## Copyright
Coldbox WordPress Theme, Copyright 2018 Toshihiro Kanai.  
The Coldbox theme is distributed under the terms of GNU GPL.

### FontAwesome License
Font License - SIL OFL 1.1  
Code License - MIT License  
URL: http://fontawesome.io/license/  
Created by Dave Gandy  

### IcoMoon License
License - GPL / CC BY 4.0  
URL: https://icomoon.io/#icons-icomoon/  
Created by Keyamoon  

### Highlight.js License
License - BSD 3-clause License  
URL: https://highlightjs.org/  
Created by @highlightjs  

### PlaceFolder Camera Icon License
License - MIT License  
URL: http://ionicons.com/  
Created by @benjsperry

### TGM Plugin Activation License
License - GPL v2 or later  
URL: http://tgmpluginactivation.com/  
Copyright (c) 2011, Thomas Griffin

### CSS minifying function
License - GPL  
URL: https://github.com/GaryJones/Simple-PHP-CSS-Minification/blob/master/minify.php  
Created by Gary Jones

### Smooth Scroll behavior polyfill
License - MIT  
URL: https://github.com/iamdustan/smoothscroll  
Created by Dustan Kasten and Jeremias Menichelli

## Changelog

1.6.3

* Fixed: Non-keyboard users friendly menu on mobile

1.6.2

* Added: New customizer option to change header menu color for mobile
* Added: Customizer validator to prevent PHP warnings
* Fixed: Aria-hidden attribute of nav toggle
* Fixed: Smooth scroll script intercepts any link with inline target
* Removed: Customizer option to use un-minified files

1.6.1

* Added: function to prevent the users from navigating outside of the search modal
* Fixed: the menu toggle is not working on mobile
* Fixed: HTML outline
* Improved: Not to use alt attribute inside of block link

1.6.0

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

1.5.5

* Fixed: Translation issues
* Fixed: Version number in the admin bar has been updated

1.5.4

* Added: You can now show post thumbnail image before the content on single pages
* Changed: Default font size - 15px for mobile and 16px for desktop
* Fixed: Some compatibilities with the newly released Coldbox Ads Extension plugin
* And includes some bug fixes and performance improvements

1.5.3

* Added: Link to privacy policy page in footer
* Added: New customizer option to choose whether it outputs the privacy policy page link
* Fixed: Feedly subscription URL

1.5.2

* Added: New hook for logo images
* Fixed: A few issues happened with the addon plugin

1.5.1

* Added: Action hooks can be used for putting some content in the single content
* Updated: About Coldbox page

1.5.0

* Added: "About Coldbox" page
* Added: New customizer option to adjust the logo width
* Added: New customizer option to select whether use narrower padding when scrolling
* Added: New customizer option to change the header menu background color for mobile
* Added: New customizer option to select whether use concatenated JS files
* Fixed: Post's published date was not showing when the published and modified date isn't same
* Fixed: Site logo was being shown too big
* Fixed: Flicker on the search modal
* Improved: flex-width logo is now supported
* Updated: Moved the customizer option "Logo" to the "Coldbox: Header Settings" from "Site Identity"
* Updated: Default font family value
* Updated: Template Hierarchy; img/ and fonts/ directories are now at assets/ folder, and czr/ directory is now at parts/ folder.
* And other small bug fixes and performance improvements.

*See [CHANGELOG.md](/CHANGELOG.md) to see all the releases*
