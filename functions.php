<?php
/**
 * Understrap Child Theme functions and definitions
 *
 * @package UnderstrapChild
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

require 'inc/customizer.php';

/**
 * Removes the parent themes stylesheet and scripts from inc/enqueue.php
 */
function understrap_remove_scripts() {
	wp_dequeue_style( 'understrap-styles' );
	wp_deregister_style( 'understrap-styles' );

	wp_dequeue_script( 'understrap-scripts' );
	wp_deregister_script( 'understrap-scripts' );
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );


/**
 * Enqueue our stylesheet and javascript file
 */
function theme_enqueue_styles() {

	// Get the theme data.
	$the_theme = wp_get_theme();

	// Grab asset urls.
	$theme_styles  = '/css/main.css';
	$theme_scripts = '/js/main.js';

	wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . $theme_styles, array(), $the_theme->get( 'Version' ) );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . $theme_scripts, array(), $the_theme->get( 'Version' ), true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );


/**
 * Load the child theme's text domain
 */
function add_child_theme_textdomain() {
	load_child_theme_textdomain( 'understrap-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );


/**
 * Overrides the understrap_bootstrap_version value to Bootstrap 5
 *
 * @return string
 */
function understrap_default_bootstrap_version() {
	return 'bootstrap5';
}
add_filter( 'theme_mod_understrap_bootstrap_version', 'understrap_default_bootstrap_version', 20 );


/**
 * Remove customizer-controls.js
 */
function understrap_child_customize_controls_js() {
	// Do nothing.
}

/**
 * Add editor stylesheet for the theme.
 */
function understrap_wpdocs_theme_add_editor_styles() {
	add_editor_style( 'css/editor.css' );
}
add_action( 'admin_init', 'understrap_wpdocs_theme_add_editor_styles' );


/**
 * Enqueue admin css.
 */
function understrap_admin_style() {
	wp_enqueue_style( 'admin_style', get_stylesheet_directory_uri() . '/css/admin.css', array(), \false, 'all' );
}
add_action( 'admin_enqueue_scripts', 'understrap_admin_style' );
