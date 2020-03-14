# Coldbox v1.8.4

[![Build Status](https://travis-ci.org/mirucon/coldbox.svg?branch=master)](https://travis-ci.org/mirucon/coldbox) [![FOSSA Status](https://app.fossa.io/api/projects/git%2Bgithub.com%2Fmirucon%2Fcoldbox.svg?type=shield)](https://app.fossa.io/projects/git%2Bgithub.com%2Fmirucon%2Fcoldbox?ref=badge_shield) [![License: GPL v2](https://img.shields.io/badge/License-GPL%20v2-blue.svg)](https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html) [![Greenkeeper badge](https://badges.greenkeeper.io/mirucon/coldbox.svg)](https://greenkeeper.io/)

![coldbox-screenshot](/screenshot.jpg)

A beautiful blog-focused WordPress theme - Coldbox. It helps increase site traffic from Google and SNS. It is easy to customize, lightweight, SEO friendly, and quicker load. This theme is fully laid out with the Flexbox module, that is, it is really flexible.

**Contributors**: [@mirucon](https://profiles.wordpress.org/mirucon/)  
**Version**: 1.8.4    
**Requires at least**: Version 5.0 or higher  
**Tested up to**: WordPress 5.3  
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

1.8.4

* fix: Do not apply tablet/PC grid column setting to mobile

1.8.3

* fix: Do not enforce 100% grid width on mobile

1.8.2

* fix: Apply grid width for classes named post/page on mobile

1.8.1

* fix: Make the heading text for "Comments" translatable
* fix: Apply grid width for classes named post/page

1.8.0

* Theme now requires WP version 5.0 or higher
* fix: babel-polyfill is conflicting with Gutenberg or some other plugins

1.7.3

* feat: Don't open all the sub-menus when focused on menu item 
* fix: Menu items are not clickable when having more than two sub-menus in the same parent menu
* And small bug fixes


1.7.2

* fix: Center the feature photo in posts by default
* fix: Menu item is not closing when holding with mouse
* fix: Delete Google Plus things
* And small bug fixes

1.7.1

* Upgrade Slack icon to their new logo
* feat: Implement new social link for Telegram
* fix: JS notice when header menu doesn't exist
* And small bug fixes and performance improvements

1.7.0

* Added: New option to use custom font size for the site title
* Fixed: Alignment of footer sidebars
* Fixed: Alignment of social links widget on footer sidebars
* Updated: Font Awesome version 5.2 from 4
* Improved: Remove Icomoon icon fonts which included unused icons and replace with Simple Icons
* Improved: Replace icons in pseudo elements with span elements
* Improved: Use Webpack to compile theme stylesheet
* Improved: Bundle theme stylesheet, Font Awesome and Simple Icons into one CSS file for better performance

1.6.4

* Added: Footer widget areas
* Fixed: The user was able to navigate outside of modal even when it's active
* Fixed: Search form issue
* Fixed: JavaScript notice when no header menu present
* Fixed: Better HTML elements

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

*See [CHANGELOG.md](/CHANGELOG.md) to see all the releases*
