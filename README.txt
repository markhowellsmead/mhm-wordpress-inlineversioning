=== Plugin Name ===
Contributors: markhowellsmead
Donate link: http://permanenttourist.ch/
Tags: versioning, assets, css, javascript
Requires at least: 4.2
Tested up to: 4.3
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Remove query parameters from asset links (JavaScript and CSS) and use inline dot notation instead.

== Description ==

Remove query parameters from asset links (JavaScript and CSS) and use inline dot notation instead. (This requires changes to Apache's .htaccess file, which are made automatically when activating the plugin.)

== Installation ==

1. Upload the plugin folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Changelog ==

= 1.2 =
* Only modify resource src if it contains `?ver=`
* Tweak PHP code spacing
* Modify plugin URI and key to reflect adoption in WordPress plugin repository.

= 1.1 =
* Update code to use `add_rewrite_rule` function.

= 1.0 =
* Initial version