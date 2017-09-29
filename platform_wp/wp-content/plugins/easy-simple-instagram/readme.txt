=== Simple Instagram Feed ===
Contributors: base29
Donate link: http://www.base29.com/
Tags: Instagram feed, instagram, easy instagram feed, simple instagram feed, free instagram feed
Requires at least: 3.0
Tested up to: 4.6
Stable tag: 1.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Simple Instagram Feed Display through shortcode and widget.

== Description ==

A simple and easy to use plugin to display your instagram feed in your wordpress blog and website. The plugin complies with the latest instagram API trends.

BEWARE: This plugin is coded by a human being. So if you find any issues or bugs please report them on our [support forum](https://wordpress.org/support/plugin/easy-simple-instagram) and we will take care of it. Because to err is human; to forgive, divine.

= Key Features =

* Easy to use.
* Supports all browsers.
* Mobile Friendly.
* Can display Instagram feed with shortcode.
* Can display Instagram feed with widget.
* User can limit the photos display.
* User can limit the display of the words in caption.

= How to use =

* Simple Usage: You can display photos on any post or page you like with a simple short code `[simple-instagram]`
* Limit Photos: You can use `[simple-instagram limit="10"]` to display specific amount of photos.
* Display Caption: Use `[simple-instagram caption="true"]` to display captions for each photo under them.
* Widget: You can also display photos through our widget which can be found in Appearance > Widgets.
* Function: Display feed anywhere in the theme by calling the global function `<?php simple_instagram($limit, $caption); ?>` (`$limit` accepts an integer and you can define any number to limit the feed and `$caption` accepts a boolean and you can enable (true) / disable (false) the captions.

= Demo =

[Click here for demo](http://demo.base29.com/simple-instagram/)

== Installation ==

= Manual Install =
1. Download the package.
2. Upload plugin folder `/easy-simple-instagram` to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.

= Install through WordPress =
1. Go to Plugins > Add New.
2. Search for `simple instagram`
3. Install it and enjoy :)

== Frequently Asked Questions ==

No data.

== Screenshots ==

1. Settings Page.
2. Getting Access Token and User ID by clicking the "Get me my Access Token and User ID" button.
3. Adding the Access Token, User ID and Hash Tag to the required fields.
4. Widget.
5. Feed display via shortcode.
6. Feed display via widget.

== Changelog ==

= v1.3 =
* Fixed some minor bugs

= v1.2 =
* Fixed User ID issue… Its compulsory now

= v1.1 =
* Created instance for development use
* Added a global function 'simple_instagram($limit, $caption);' to display feed anywhere in theme
* Added setting link in plugins listing area

= v1.0.9 =
* Added error handling

= v1.0.8 =
* Added rate us box and suggextions box
* Fixed missing closing anchor tag

= v1.0.7 =
* Typo fix

= v1.0.6 =
* Fix a minor CSS issue
* Proper documented code

= v1.0.5 =
* Added caption word limit option
* Added hide/show of follow button
* Added uninstall.php
* Fixed some bugs

= v1.0.4 =
* Caption display option bug fix

== Upgrade Notice ==

No upgrade availabe.
