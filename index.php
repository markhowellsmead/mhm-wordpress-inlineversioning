<?php
/*
Plugin Name: Inline version numbering for WordPress
Plugin URI: https://wordpress.org/plugins/mhm-inlineversioning/
Description: Remove query parameters from asset links (JavaScript and CSS) and use inline dot notation. (This requires changes to Apache's .htaccess file, which are made automatically when activating the plugin.)
Author: Mark Howells-Mead
Version: 1.2
Author URI: http://permanenttourist.ch/
*/

class MHM_Inlineversioning {

	public $key 	= 'mhm-inlineversioning';
	public $version = '1.2';

	public function __construct(){
		add_filter( 'style_loader_src', array(&$this, 'parse_uri'), 10, 2 );
		add_filter( 'script_loader_src', array(&$this, 'parse_uri'), 10, 2 );
		register_activation_hook( __FILE__, array( &$this, 'add_rules' ) );
		register_deactivation_hook( __FILE__, array( &$this, 'remove_rules' ) );
	}

	public function remove_rules(){
		flush_rewrite_rules();
	}
	
	public function add_rules(){
  	add_rewrite_rule('(.+)\.(\d+)\.(js|css)$', '$1.$3', 'top');
		flush_rewrite_rules();
  }

	function parse_uri( $src ) {

		if( strpos( $src, '?ver=' ) ){
			$src = remove_query_arg( 'ver', $src );

  		$active_theme = wp_get_theme();
  		$version = $active_theme->get( 'Version' );
  		$version = str_replace('.','',$version);
  
  		$pathinfo = pathinfo($src);
  
  		$src = preg_replace('~(\.' .$pathinfo['extension']. ')~', '.'.$version.'${1}', $src);
		}
    return $src;

	}

}

new MHM_Inlineversioning();