<?php
/**
 *	Theme functions and definitions
 *	@package WordPress
 */


/** Tell WordPress to run theme_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'theme_setup' );

if ( ! function_exists( 'theme_setup' ) ):
/**
 *	Sets up theme defaults and registers support for various WordPress features.
 *
 *	Note that this function is hooked into the after_setup_theme hook, which runs
 *	before the init hook. The init hook is too late for some features, such as indicating
 *	support post thumbnails.
 */
function theme_setup() {

	include('inc/misc-theme-setup.php');
	include('inc/image-sizes.php');
	include('inc/register-nav-menus.php');
	include('inc/custom-post-types.php');
	
}
endif;

include('inc/remove-columns-from-tables.php');
include('inc/excerpt-and-read-more-links.php');
include('inc/misc-functions.php');
include('inc/theme-specific-functions.php');
include('inc/wysiwyg.php');