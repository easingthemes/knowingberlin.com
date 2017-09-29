=== SrbTransLatin ===
Contributors: pedjas
Tags: transliteration, serbian, cyrillic, latin, multilanguage, script
Requires at least: 2.6.1
Tested up to: 4.8
Stable tag: trunk

SrbTransLatin handles using Serbian language Cyrillic and Latin script. For Cyrillic content, visitor may choose to view it using Cyrillic or Latin.

== Description ==

SrbTransLatin handles using Serbian language Cyrillic and Latin script. For Cyrillic content, visitor may choose to view it using Cyrillic or Latin.

Contents of the site should be written using Cyrillic script. Then, this plugin will allow users to choose to read contents in Cyrillic or Latin script.

If some contents is entered in Latin script, it would stay in Latin even if user chooses to use Cyrillic. Transliteration occurs only from Cyrillic to Latin script.

Site owner may set default for script to show: 

- Cyrillic,

- Latin and

- Cyrillic if visitor accepts it (has set some Cyrillic language as acceptable in his browser)

Script also may be selected manually, by adding ?lang=cir or ?lang=lat to document url. If parameter is not specified default script is used.

Site owner may use widget to allow visitors to choose among Cyrillic and Latin script. He may choose if script options are shown as html links or items of combo box. By default, html link are dipslayed. He also may set if widget would show title or not.

When user selects script, his choice stays permanent while he is on site. All internal links within site are altered to contain information about selected script. This means, when link is copied and pasted to some other site, it would contain information which script to use for displaying contents. There is an option to remember choosen script as cookie in visitor's brower so he has no need to set it again on future visits.

Initially, when new article is posted using Cyrillic script in title, permalink is created with conversion to Latin script. Site owner may turn it of.

Transliteration works for all feeds too (atom, rdf, rss, rss2).

**Disabling transliteration for part of page contents**

When transliteration occurs, everything in the HTML document is transliterated from Cyrillic to Latin script except if contents is placed among [lang id="skip"] and [/lang] tags. This leaves user to mark part of the text he does not want to be transliterated at all, meaning, some parts of Cyrillic text may stay Cyrillic even if user chooses to view site in Latin script.

**Changing image depending on selected script**

If you want to add image on page which contains Cyrillic text and you want it to be replaced with image that contains Latin script then add =cir= as suffix in image name. On transliteration, Image name will be changed to have =lat= as suffix.

Example: filename=cir=.jpg will be replaced with filename=lat=.jpg

You have to provide Latin version image at same path as Cyrillic image is placed, of course.

You may use other delimiter besides "=". You have to set delimiter in plugin settings. Delimiter may be more than one character long. For example, if you set delimiter to "-" then file name filename-cir-.jpg will be replaced with filename-lat-.jpg

Script mark may be placed anywhere in path, not just file name.

**Using script selector on custom places**

If you need to put script selector in site template outside widgets areas then you can use function stl_show_selector() provided with plugin. Function accepts four parameters (all optional):

stl_show_selector (selector_type, oneline_separator, cyrillic_caption, latin_caption, inactive_script_only, show_only_on_wpml_languages)

*selector_type* chooses which type of selector to display: 

- links - list of choices in form of widget items

- list - list of choices in form of dropdown selection

- oneline - list of choices as one line separated by oneline_separator
	
Default value is 'oneline'
	
	
*oneline_separator* is a string that should be inservted between script selection items. Default value is '/'.

*cirillic_caption* is a string that should be used as caption for item of cyrillic sleection. Default is 'ћирилица'

*latin_caption* is a string that should be used as caption for item of latin sleection. Default is 'латиница'

*inactive_script_only* if checked dosplays only option to select inactive script, currently active script wil not be an option

*show_only_on_wpml_languages* contains list of WPML languages comma separated for which script selection swhould be visible

To use this function just call it from place where you need code to be inserted, like:

`<?php stl_show_selector('oneline', '/', 'ћирилица', 'латиница') ?>`


**Using script info in custom code**

You may use some info about script state for customizing templates. Here are available functions:

stl_get_current_script() - returns id of currently displayed script. It returns id as set in plugin options.

stl_is_current_cyrillic() - returns true if currently displayed script is Cyrillic.

stl_is_current_latin() - returns true if currently displayed script is Latin.

stl_get_cyrillic_id() - returns id of Cyrillic script as set in plugin settings.

stl_get_latin_id() - returns id of Lating script as set in plugin settings.

stl_get_script_identificator() - returns identificator used in URL to select script as set in plugin settings.


**Sanitizing file names**

When files are uploaded to Wordpress site, it is not good to let them have Cyrillic characters in file names. SrbTransLatin has optin to clean such characters and replace them with appropriate latin characters.

**Fix url colision with other plugins**

There are some plugings that also use default identificator 'lang', which SrbTransLatin uses to pass selected script information through url. To fix this there is an option to set this identificator. If you have problems with other plugins just change this to 'script' or 'lng', or something else as you like.

Pay attention that if you change this option, all previous urls containing script selection will become invalid. It is best to set this before site is heavily indexed or externally linked.


**Fix priority colision with other plugins**

SrbTransLatin as a rule should be the last plugin executed, so it can process page content after all content is generated by other plugins. At least it should be the last of plugins that generate content.

By default, SrbTranslatin uses priority 99 to make good chance to be at the end of executing plugin list. If for some reason it does not work well, user can change priority. 

There is config_example.php in SrbTransLatin directory. User should copy that to config.php and edit new file. There is a line saying:

$stl_config['priority'] = 9999;

User may change number 9999 to any other. Greater number is lower priority, meaning exexuting after plugins with lower number.


**WPML compatibility**

It is quote often that users of SrbTranslatin als use WPML and they meet with conflict as both plugins use the same language identificator 'lang'. SrbTransLatin has an option for user to set different language identificator to resolve conflict. It is recommend to use 'script' as identificator.

Moreoever, on installation, SrbTranslatin will check if WPML is installed and it will change it's language identificator. Also, when conflict is possible, warning will be presented to user while in SrbTransLatin settings.

When setting widget, or using user have an option to set language identificators used by WPML which for widget will be invisible.


**Acknowledgements**

This plugin is developed inspired by two plugins WP Translit by Aleksandar Urošević and srlatin by Kimmo Suominen. I actually merged functionality of these two and expanded it with a lot of new functionality I needed for my site, and later with new functionality asked by plugin users.



== Installation ==

1. Extract package and upload `srbtranslatin` directory to `/wp-content/plugins/srbtranslatin` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Add widget `Serbian Transliteration (links)` or `Serbian Transliteration (list)` and set it's options:
    - set title for script selection wigdet (default: Избор писма)
    - set if title should be shown for script selection widgets (default: title is not shown)
    - set if script selection is displayed as web links or options of combo box

Open Settings / SrbTransLat and set parameters according to your needs:

- set default script to be used if user do not make choice of script (default: Cyrillic)
- set if you want selected script to be saved in visitor's browser cookie
- set if permalinks are autogenerated in Latin script even if title is in Cyrillic (default: conversion to Latin)


== Frequently Asked Questions ==

= Can this transliterate my blog which uses Serbian Latin script into Serbian Cyrillic? =

No. Such conversion is hard if imposible due to not unique transliteration rules. It is recomended that you create contents on your site using Cyrillic script if you need both scripts.

= Plugin transliterates everything but page title in HEAD section of HTML? =

This happens on some installations. It seems it is dependable on template used, like some templates interfere with wp hooks regarding page title.

= I use multilanguange plugin along with SrbTransLatin, but it does not work well? =

Usually, problems with multilanguage plugins is interference with url parameter name. Try changing default script identificatin in SrbTransLatin options.

= When I change to nondefault script some images are not shown on page? =

Use latin alphabet in image file names only. If you use Cyrillic letters in file names, they will be transliterated to rendering wrong file name.

= I have some images on page that I want to switch from Cyrillic and Latin version along with text contents? =

Prepare original image with Cyrillic contents by adding keyword -cir- in image file name, for example myimage-cir-.jpg. Prepare Latin version of the same image naming it using -lat- keyword, like myimage-lat-.jpg. When page is displayed, image will be loaded regarding selected script. Delimiter character '-' may be customly set.

= I tried to use script tags in image names but it does not work =

On some Wordpress installations, when you upload images Wordpress strips some characters from file names. Check if files have proper file names after upload.

If some characters are stripped you may try uploading file directly (using FTP for example). 

If file name script delimiter is stripeed you may change it in plugin settings. You may use any character acceptable in file name syntax. Even better, you may set several characters for delimiter to avoid collisions. Do not forget to name all files to match new delimiter.

= I uploaded file with Cyrillic characters in file name. Plugin transliterates it to latin so I end up with invalid file name =

You should not use Cyrillic characters in file name. It is not that just this plugin does not like it, it is wrong onhigher level. Always use Roman Latin characters in file names. 

However, as it frequently happens that users upload files with Cyrillic character in file names, SrbTranslatin has option to sanitize such file names. If turned on, it will replace Cyrillic characters with apropriate Latin characters and rename file on upload. That will make sure that you have proper file names.

= How to prevent part of the text to be transliterated to Latin? =

Place text you do not want to be transliterated into block surrounded by [lang id="skip"] and [/lang]. 

Example: [lang id="skip"]this text will not be transliterated[/lang]

= Some contents of the page does not work properly when SrbTransLatin is active? =

If you use some JavaScript on page and it autogenerates objects using page contents, it may hapen that JavaScript uses Cyrillic contents in object names or other langage elements. When SrbTransLatin renders page it would process all Cyrillic contents including JavaScript. Make sure that IDs of objects (images especially) are not in Cyrillic script.

= Some contents of the page is not transliterated to latin? =

- Check if you used [lang id="skip"] and [/lang] on that block of text.

- Make sure your plugin is run with lowest priority so it process page contents after it is all generated by other plugins.

- Contents of the page which is dynamically generated (JavaScript or so) usually cannot be transliterated using SrbTransLatin.

= Search option finds contents only if it matches search keyword script. Is it possible that it find everything regardless of the script? =

Search is done in database, not in Wordpress code. Database does not provide means to disregard scripts in search keywords without significant reconfiguration of database server. Most hosting services do not even allow such reconfiguration. I am trying to think of solution for this issue.

= I want to show script selection in custom template, not by widget. Is it possible? =

Yes. See description of function stl_show_selector() provided by this plugin.

= I want to customize template, based by selected script. Is it possible? =

Yes. See description of functions stl_show_selector(), stl_get_current_script(), stl_is_current_cyrillic(), stl_is_current_latin(), stl_get_cyrillic_id(), stl_get_latin_id(), and stl_get_script_identificator() provided by this plugin.

= This is really nice script which I use on my site. Can I donate some money to the author? =

No. This is free to use script. If you want to show appreciation, spread the word, share the link to http://pedja.supurovic.net/projekti/srbtranslatin


== Changelog ==

= 1.43 =

Fixed constructor warning with PHP 7.

= 1.42 =

Added globaly available functions:
stl_get_current_script(), stl_is_current_cyrillic(), stl_is_current_latin(), stl_get_cyrillic_id(), stl_get_latin_id(), stl_get_script_identificator().

= 1.41 =

New option to sanitize Cyrillic characters from file name on file name upload.

Default file script delimiter is now '-'. From some version, Wordpress made earlier delimiter '=' unusable, so there is no point of using it any more.

= 1.40 =

Removed language query parameter adding to image urls in src, srcset and background as unnecessary overhead.

= 1.39 =

Fixed bug with option to check if user web browser supports Cyrilic. Option removed.

Fixed bug with inserting language identificator in links when not necessary.

= 1.38 =

More fixes parsing file name tags in links within page.

Added new option. User now can set delimiter used for marking language in file name or path.

= 1.37 =

Additional fix parsing img tags for Cyrillic and Latin image replacement.

= 1.36 =

Fixed bug with parsing [lang] tags, and also parsing img tags for cyrillic and latin image replacement.

= 1.35 =

Altered tansliteration procedure, which should now alow transliterated posts to be used even with javascript/ajax.

= 1.34 =

Fixed bug on handling before widget and after widget.

Fixed bug transliterating blog header title.

= 1.33 =

Added option to display only option to select non current script

Addedd option for WPML users to set if thez want SrbTransLatin Widget to be invisible on specific languages.

= 1.31 =

Fixed bug with transliterating title to permalink option in settings

Added helper for conflicts with WPML. WPML uses 'lang' as language identificator which is the same as default for SrbTransLatin. Now if WPML is installed default changes to 'script', and if identificator is set to 'lang' warning is shown to user.


= 1.30 =

Fixed bug with transliterating title to permalink


= 1.29 =

Added external configuration using config.php


= 1.28 =

Fixed displaying cookie using state setting option.


= 1.27 =

Function stl_show_selector() expanded with two new parameters allowing setting captions for script selection items.

= 1.26 =

Added option to let user change script identificator in url.

Added option to switch image on script change. If you use filename=cir=.jpg as image name, if latin script is selected, then image named filename=lat=.jpg will be used instead.

= 1.25 =

Changed priority of the plugin so it allows other plugins to alter contents before transliteration.


= 1.24 =

Added option which allows user to customize title for Cyril and Latin options in widget.


= 1.23 =

Minor fix. Title of 'latinica' was displayed using Cyrillic script. Changed to Latin script.

= 1.22 =

Fixed permalink transliteration issues with the latest Wordpress version.

Added function stl_show_selector() which may be used to insert script selector anywhere in template.


= 1.21 =

Added full support for exernal language files and Serbian translation included.


= 1.20 =

Partialy rewriten code according to new Wordpress API. Also, some new functionality added.


== Upgrade Notice ==

= 1.20 =

Widget is rewritten. Widget settings are separated from plugin options to widget options form. Thus, after update you will loose widget settings. Do not forget to check them out after upgrade.