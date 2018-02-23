<?php
/**
 * _s functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package _s
 */

add_filter( 'show_admin_bar', '__return_false' );

if ( ! function_exists( 'default_setup' ) ) :
	function default_setup() {
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
	}
endif;
add_action( 'after_setup_theme', 'default_setup' );
function default_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'default_content_width', 640 );
}
add_action( 'after_setup_theme', 'default_content_width', 0 );

// https://wordpress.stackexchange.com/questions/91678/how-to-prevent-wordpress-from-loading-the-jquery-library-at-the-top-of-the-page
// remove header links
add_action('init', 'tjnz_head_cleanup');
function tjnz_head_cleanup() {
    remove_action( 'wp_head', 'feed_links_extra', 3 );                      // Category Feeds
    remove_action( 'wp_head', 'feed_links', 2 );                            // Post and Comment Feeds
    remove_action( 'wp_head', 'rsd_link' );                                 // EditURI link
    remove_action( 'wp_head', 'wlwmanifest_link' );                         // Windows Live Writer
    remove_action( 'wp_head', 'index_rel_link' );                           // index link
    remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );              // previous link
    remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );               // start link
    remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );   // Links for Adjacent Posts
    remove_action( 'wp_head', 'wp_generator' );                             // WP version
    if (!is_admin()) {
        wp_deregister_script('jquery');                                     // De-Register jQuery
        wp_register_script('jquery', '', '', '', true);                     // Register as 'empty', because we manually insert our script in header.php
    }
}

/**
 * Enqueue scripts and styles.
 */
function default_scripts() {
	wp_enqueue_style( 'app', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'default_scripts' );

/**
 * Debug functions
 */
function debug($var, $method='print_r', $vartype='array', $die=false)
{
  echo '<pre>';
  if ($method=='vardump')
  {
    var_dump($var);
  }
  else if ($method=='print_r')
  {
    print_r($var);
  }
  echo '</pre>';
}
