=== Plugin Name ===
Contributors: markhowellsmead
Donate link: https://www.paypal.me/mhmli
Tags: versioning, assets, css, javascript
Requires at least: 4.2
Tested up to: 4.4
Stable tag: 4.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Remove query parameters from asset links (JavaScript and CSS) and use inline dot notation instead.

== Description ==

Remove query parameters from asset links (JavaScript and CSS) and use inline dot notation instead. (This requires changes to Apache's .htaccess file.)

== Installation ==

1. Upload the plugin folder to the `/wp-content/plugins/` directory
2. Make a backup copy of the .htaccess file in the root directory of your site, if there is one.
3. Activate the plugin through the 'Plugins' menu in WordPress

== Changelog ==

= 2.5 =
* Remove htaccess rule when deactivating plugin.
* Confirm functionality in WordPress 4.4.

= 2.4 =
* Ensure that .htaccess rules are maintained cleanly when accessing Permalink section in wp-admin.
* Thanks to http://wordpress.stackexchange.com/users/1685/thedeadmedic for the assistance.

= 2.3 =
* Extend regex pattern in .htaccess to recognize version numbers containing dots and dashes.

= 2.2 =
* Use the `admin-init` hook to update the .htaccess file whenever the version number changes. (e.g. when updating the plugin from the repository.) This is in addition to the modification which takes place when the plugin is activated.
* Minor corrections to README.

= 2.1.1 =
* Temporarily remove .htaccess update on plugin update, due to a bug.

= 2.1 =
* Update .htaccess when the plugin is updated from the plugin repository.
* Correct version number across all files in the plugin.

= 2.0 =
* Use better code solution by Dominik Schilling. (https://dominikschilling.de/880/) No copyright breach intended: just making this plugin code available through the WordPress Plugin Directory.

= 1.2 =
* Only modify resource src if it contains `?ver=`
* Tweak PHP code spacing
* Modify plugin URI and key to reflect adoption in WordPress plugin repository.

= 1.1 =
* Update code to use `add_rewrite_rule` function.

= 1.0 =
* Initial version