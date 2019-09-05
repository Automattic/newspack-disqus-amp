<?php
/**
 * Plugin Name: Newspack Disqus AMP
 * Description: Adds AMP-compatibility to the Disqus plugin.
 * Version: 1.0.0
 * Author: Automattic
 * Author URI: https://newspack.blog/
 * License: GPL2
 * Text Domain: newspack-disqus-amp
 * Domain Path: /languages/
 */

defined( 'ABSPATH' ) || exit;

class Newspack_Disqus_AMP {

	public static function init() {
		if ( ! function_exists( 'is_plugin_active' ) ) {
			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		}

		if ( ! is_plugin_active( 'disqus-comment-system/disqus.php' ) ) {
			return;
		}

		add_filter( 'comments_template', [ __CLASS__, 'render_comments' ] );
		add_filter( 'dsq_can_load', [ __CLASS__, 'dont_load_disqus_scripts_on_amp' ] );
	}

	public static function dont_load_disqus_scripts_on_amp( $script ) {
		if ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() ) {
			return false;
		}
		return $script;
	}

	public static function render_comments( $template ) {
		if ( ! comments_open() || ! is_singular() || ! function_exists( 'is_amp_endpoint' ) || ! is_amp_endpoint() ) {
			return $template;
		}

		return dirname( __FILE__ ) . '/comments-template.php';
	}

}
Newspack_Disqus_AMP::init();