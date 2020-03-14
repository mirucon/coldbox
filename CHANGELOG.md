### 1.8.4 <small> - March 14th, 2020</small>

* fix: Do not apply tablet/PC grid column setting to mobile

### 1.8.3 <small> - March 9th, 2020</small>

* fix: Do not enforce 100% grid width on mobile

### 1.8.2 <small> - February 16th, 2020</small>

* fix: Apply grid width for classes named post/page on mobile

### 1.8.1 <small> - February 10th, 2020/small>

* fix: Make the heading text for "Comments" translatable
* fix: Apply grid width for classes named post/page

### 1.8.0 <small> - October 20th, 2019</small>

* Theme now requires WP version 5.0 or higher
* fix: babel-polyfill is conflicting with Gutenberg or some other plugins

### 1.7.3 <small> - September 24nd, 2019</small>

* feat: Don't open all the sub-menus when focused on menu item 
* fix: Menu items are not clickable when having more than two sub-menus in the same parent menu
* And small bug fixes

### 1.7.2 <small> - April 22nd, 2019</small>

* fix: Center the feature photo in posts by default
* fix: Menu item is not closing when holding with mouse
* fix: Delete Google Plus things
* And small bug fixes

### 1.7.1 <small> - February 1st, 2019</small>

* Upgrade Slack icon to their new logo
* feat: Implement new social link for Telegram
* fix: JS notice when header menu doesn't exist
* And small bug fixes and performance improvements

### 1.7.0 <small> - August 23rd, 2018</small>

* Added: New option to use custom font size for the site title
* Fixed: Alignment of footer sidebars
* Fixed: Alignment of social links widget on footer sidebars
* Updated: Font Awesome version 5.2 from 4
* Improved: Remove Icomoon icon fonts which included unused icons and replace with Simple Icons
* Improved: Replace icons in pseudo elements with span elements
* Improved: Use Webpack to compile theme stylesheet
* Improved: Bundle theme stylesheet, Font Awesome and Simple Icons into one CSS file for better performance

### 1.6.4 <small> - August 9th, 2018</small>

* Added: Footer widget area
* Fixed: The user was able to navigate outside of modal even when it's active
* Fixed: Search form issue
* Fixed: JavaScript notice when no header menu present
* Fixed: Better HTML elements

### 1.6.3 <small> - August 8th, 2018</small>

* Fixed: Non-keyboard-users-friendly menu on mobile

### 1.6.2 <small> - August 1st, 2018</small>

* Added: New customizer option to change header menu color for mobile
* Added: Customizer validator to prevent PHP warnings
* Fixed: Aria-hidden attribute of nav toggle
* Fixed: Smooth scroll script intercepts any link with inline target
* Removed: Customizer option to use un-minified files

### 1.6.1 <small> - July 23rd, 2018</small>

* Added: function to prevent the users from navigating outside of the search modal
* Fixed: the menu toggle is not working on mobile
* Fixed: HTML outline
* Improved: Not to use alt attribute inside of block link

### 1.6.0 <small> - July 6th, 2018</small>

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


### 1.5.5 <small> - June 27th, 2018</small>

* Fixed: Translation issues
* Fixed: Version number in the admin bar has been updated

### 1.5.4 <small> - June 24th, 2018</small>

* Added: You can now show post thumbnail image before the content on single pages
* Changed: Default font size - 15px for mobile and 16px for desktop
* Fixed: Some compatibilities with the newly released Coldbox Ads Extension plugin
* And includes some bug fixes and performance improvements

### 1.5.3 <small> - May 27th, 2018</small>

* Added: Link to privacy policy page in footer
* Added: New customizer option to choose whether it outputs the privacy policy page link
* Fixed: Feedly subscription URL

### 1.5.2 <small> - May 6th, 2018 </small>

* Added: New hook for logo images
* Fixed: A few issues happened with the addon plugin

### 1.5.1 <small> - April 7th, 2018 </small>

* Added: Action hooks can be used for putting some content in the single content
* Updated: About Coldbox page

### v1.5.0 <small> - April 6th, 2018 </small>

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

### v1.4.1 <small> - March 31st, 2018 </small>

* Fixed: Default option of a customizer option was not working properly
* Fixed: Load non-minified CSS/JS when script debug is on
* Updated: No more SNS Count Cache plugin recommendation

### v1.4.0 <small> - December 4th, 2017 </small> 

* Improved: Start using a bit modern functions
* Changed: Template hierarchy; all the CSS/JS files are now at assets folder
* Fixed: Minor security bug

### v1.3.3 <small> - November 26th, 2017 </small>

* Added: New customizer settings:
  * Change the footer menu color
  * Set the number of grid columns for mobile
* Fixed: Archive pages layout when the number of grid columns is set more than one for mobile

### v1.3.2 <small> - November 26th, 2017 </small>

* Fixed: Now the Coldbox theme uses more modern functions
* Tested up to 4.9

### v1.3.1 <small> - October 18th, 2017 </small>

* Added: Direct editing links for social links on customizer
* Improved: Customizer

### v1.3.0 <small> - October 1st, 2017 </small>

* Added: New customizer setting for editing grid columns
* Added: Support for footer menu
* Improved: Customizer styling
* Improved: Typography for menu

### v1.2.9 <small> - September 27th, 2017 </small>

* Improved: Both logo and title can be shown in the same time

### v1.2.8 <small> - September 21st, 2017 </small>

* Fixed: Sidebar for AMP pages

### v1.2.7 <small> - September 20th, 2017 </small>

* Added: New customizer settings to change background colors
* Improved: Field style

### v1.2.6 <small> - September 2nd, 2017 </small>

* Minor bug fixes

### v1.2.5 <small> - September 2nd, 2017 </small>

* Fixed: Escaping issues

### v1.2.4 <small> - September 2nd, 2017 </small>

* Fixed: Function names that are missing prefixes
* Fixed: The widget's filter elements
* Fixed: Duplicated posts are shown on related posts
* Improved: Credit link

### v1.2.3 <small> - August 15th, 2017 </small>

* Fixed: Customizer options

### v1.2.2 <small> - August 12th, 2017 </small>

* Added: TGM Plugin Activation
* Fixed: Template action hooks

### v1.2.1 <small> - August 8th, 2017 </small>

* Fixed: Comments template

### v1.2.0 <small> - August 6th, 2017 </small>

* Added: Get ready for the addon plugin features:
  * AMP pages
  * Share buttons
  * Download the addon plugin here: https://github.com/mirucon/coldbox-addon/
* Added: Action hooks for several usage
* Added: Full width page template
* Changed: Footer text color
* Fixed: Minor styling bug
* Fixed: Nav toggle styling
* Improved: Loading speed of scripts
* Improved: Followed the latest version of WordPress Coding Standards

### v1.1.5 <small> - July 27th, 2017 </small>

* Added: Masonry responsive sidebar
* Bug Fixes

### v1.1.4 <small> - July 25th, 2017 </small>

* Added: Non minified version of the JS files
* Fixed: "Display post dates on grid" option

### v1.1.3 <small> - July 21st, 2017 </small>

* Fixed: Header text color on customizer
* Fixed: Display site title and tagline option on customizer

### v1.1.2 <small> - July 20th, 2017 </small>

* Added: An option to select showing the site title
* Added: Print styling
* Improved: The wording when no results found on the search result pages
* Improved: Attachment pages view
* Removed: Unused customizer setting
* Removed: Unnecessary PHP tags
* Fixed: The color of h tags on pre tags

### v1.1.1 <small> - July 20th, 2017 </small>

* Added: Social links widget
* Added: New search form design
* Added: Selectable sticky header
* Added: Action hooks that allow you to add some contents on the bottom of each page
* Improved: Follows the WP coding standards

### v1.1.0 <small> - July 9th, 2017 </small>

* Added: Social links option
* Added: Doc comments
* Added: Concat / minified JS files
* Added: Changeable font-family
* Added: Editable footer copyright
* Improved: Use both tags and categories to get related posts
* Improved: Standard contents styling
* Changed: Default font to Source Sans Pro from Open Sans 
* Moved: Social share buttons to the add-on plugin

### v1.0.2 <small> - June 16th, 2017 </small>

* Bug fixes

### v1.0.1 <small> - June 9th, 2017 </small>

* Bug fixes

### v1.0 <small> - June 8th, 2017 </small>

* Initial release
