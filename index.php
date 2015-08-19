<?php
/*
Plugin Name: Inline version numbering for WordPress
Plugin URI: https://github.com/mhmli/mhm-wordpress-inlineversioning
Description: Remove query parameters from asset links (JavaScript and CSS) and use inline dot notation. (This requires changes to Apache's .htaccess file, which are made automatically when activating the plugin.)
Author: Mark Howells-Mead
Version: 1.0
Author URI: http://permanenttourist.ch/
*/

class MHM_WordPress_Inlineversioning {

	public $key 	= 'mhm-wordpress-inlineversioning';
	public $version = '1.0';
	
	function dump($var,$die=false){
		echo '<pre>' .print_r($var,1). '</pre>';
		if($die){die();}
	}//dump

	public function __construct(){
		add_filter( 'style_loader_src', array(&$this, 'parse_uri'), 10, 2 );
		add_filter( 'script_loader_src', array(&$this, 'parse_uri'), 10, 2 );
		register_activation_hook( __FILE__, array( &$this, 'add_rules' ) );
		register_deactivation_hook( __FILE__, array( &$this, 'remove_rules' ) );
	}

	private function flush_rules(){
		global $wp_rewrite;
		$wp_rewrite->flush_rules(true);
	}

	public function remove_rules(){
		$this->remove_rule_flag = true;
		remove_action( 'generate_rewrite_rules', array( &$this, 'add_rules') );
		$this->flush_rules();
	}
	
	public function add_rules(){
		global $wp_rewrite;
		$non_wp_rules = array('(.+)\.(\d+)\.(js|css)$' => '$1.$3 [L]');
		$wp_rewrite->non_wp_rules = $non_wp_rules + $wp_rewrite->non_wp_rules;
		$this->flush_rules();
	}

	function parse_uri( $src ) {
		if( strpos( $src, '?ver=' ) ){
			$src = remove_query_arg( 'ver', $src );
		}

		$active_theme = wp_get_theme();
		$version = $active_theme->get( 'Version' );
		$version = str_replace('.','',$version);

		$pathinfo = pathinfo($src);

		$src = preg_replace('~(\.' .$pathinfo['extension']. ')~', '.'.$version.'${1}', $src);

	    return $src;
	}

}

new MHM_WordPress_Inlineversioning();