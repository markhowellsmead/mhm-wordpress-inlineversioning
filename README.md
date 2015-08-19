# Inline version numbering for WordPress
WordPress plugin. Remove query parameters from asset links (JavaScript and CSS) and use inline dot notation instead. (This requires changes to Apache's .htaccess file, which are made automatically when activating the plugin.)

## Usage
Install the plugin. Clear any caches and check that your CSS and JavaScript files are still correctly loaded in the browser. If not, then make sure that the appropriate rules have been added to your .htaccess files.

	RewriteRule ^(.+)\.(\d+)\.(js|css)$ /$1.$3 [L] [QSA,L]

##Author
Mark Howells-Mead | www.permanenttourist.ch | Since August 2015

##License
Use this code freely, widely and for free. Provision of this code provides and implies no guarantee.

Please respect the GPL v2 licence, which is available via http://www.gnu.org/licenses/gpl-2.0.html