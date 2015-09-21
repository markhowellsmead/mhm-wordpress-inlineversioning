<?php
/*
Plugin Name: Inline version numbering for WordPress
Plugin URI: https://wordpress.org/plugins/mhm-inlineversioning/
Description: Remove query parameters from asset links (JavaScript and CSS) and use inline dot notation. This requires changes to Apache's .htaccess file, which are made automatically when activating the plugin.)
Author: Mark Howells-Mead (original Dominik Schilling, https://dominikschilling.de/880/.)
Version: 2.2.1
Author URI: http://permanenttourist.ch/
*/

class MHM_Inlineversioning {

	public $key 		= 'mhm-inlineversioning';
	public $version = '2.2.1';

	public function __construct(){
		add_filter( 'style_loader_src', array(&$this, 'parse_uri'), 10, 2 );
		add_filter( 'script_loader_src', array(&$this, 'parse_uri'), 10, 2 );
		register_activation_hook( __FILE__, array( &$this, 'add_rules' ) );
		register_deactivation_hook( __FILE__, array( &$this, 'remove_rules' ) );
		add_action( 'admin_init', array( &$this, 'check_version' ) );
	}
	
	public function check_version(){
		if ( get_site_option( 'mhm-inlineversioning-plugin-version' ) !== $this->version ) {
			update_option('mhm-inlineversioning-plugin-version', $this->version);
 			$this->add_rules();
    }
	}

	public function remove_rules(){
		flush_rewrite_rules();
		delete_option( 'mhm-inlineversioning-plugin-version' );
	}
	
	public function add_rules(){
  	add_rewrite_rule('(.+)\.(\d+)\.(js|css)$', '$1.$3', 'top');
		flush_rewrite_rules();
  }

	/**
	 * Moves the `ver` query string of the source into
	 * the filename. Doesn't change admin scripts/styles and sources
	 * with more than the `ver` arg.
	 * The contents of this function have been taken from https://dominikschilling.de/880/
	 * as Dominik's version is better, but isn't available through the WordPress Plugin Directory.
	 *
	 * @param  string $src The original source.
	 * @return string
	 */
	function parse_uri( $src ) {

		// Don't touch admin scripts.
		if ( is_admin() ) {
			return $src;
		}
	
		$_src = $src;
		if ( '//' === substr( $_src, 0, 2 ) ) {
			$_src = 'http:' . $_src;
		}
	
		$_src = parse_url( $_src );
	
		// Give up if malformed URL.
		if ( false === $_src ) {
			return $src;
		}
	
		// Check if it's a local URL.
		$wp = parse_url( home_url() );
		if ( isset( $_src['host'] ) && $_src['host'] !== $wp['host'] ) {
			return $src;
		}
	
		return preg_replace(
			'/\.(js|css)\?ver=(.+)$/',
			'.$2.$1',
			$src
		);

	}
}

new MHM_Inlineversioning();