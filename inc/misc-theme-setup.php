<?php
/**
 * Theme set-up scripts
 */

/** Add default posts and comments RSS feed links to head.*/
add_theme_support('automatic-feed-links');

/** This theme uses its own gallery styles.*/
add_filter('use_default_gallery_style', '__return_false');

/*
 * Switch default core markup for search form, comment form, and comments
 * to output valid HTML5.
 */
add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));

if(function_exists('acf_add_options_page')){
	acf_add_options_page();
}

/** Refer to Posts as News (as this makes more sense to people) */
function img_change_post_label() {
	global $menu;
	global $submenu;
	$menu[5][0] = 'News';
	$submenu['edit.php'][5][0] = 'News';
	$submenu['edit.php'][10][0] = 'Add News';
	$submenu['edit.php'][16][0] = 'News Tags';
	echo '';
}

function img_change_post_object() {
	global $wp_post_types;
	$labels = &$wp_post_types['post']->labels;
	$labels->name = 'News';
	$labels->singular_name = 'News';
	$labels->add_new = 'Add News';
	$labels->add_new_item = 'Add News';
	$labels->edit_item = 'Edit News';
	$labels->new_item = 'News';
	$labels->view_item = 'View News';
	$labels->search_items = 'Search News';
	$labels->not_found = 'No News found';
	$labels->not_found_in_trash = 'No News found in Trash';
	$labels->all_items = 'All News';
	$labels->menu_name = 'News';
	$labels->name_admin_bar = 'News';
}
add_action('admin_menu', 'img_change_post_label');
add_action('init', 'img_change_post_object');

/** Change Next/Previous links */
function posts_link_attributes_next() {
	return 'class="news-navigation__button news-navigation__button--next"';
}

function posts_link_attributes_previous() {
	return 'class="news-navigation__button news-navigation__button--previous"';
}

add_filter('next_posts_link_attributes', 'posts_link_attributes_next');
add_filter('previous_posts_link_attributes', 'posts_link_attributes_previous');


function post_link_attributes($output) {
	$code = 'class="news-navigation__button"';
	return str_replace('<a href=', '<a ' . $code . ' href=', $output);
}

add_filter('next_post_link', 'post_link_attributes');
add_filter('previous_post_link', 'post_link_attributes');

/** Add class to wp_nav_menu <li> tags */
function my_nav_special_class($classes, $item, $args){
	if(empty($args->menu_class)){
		$args->menu_class = 'site-nav';
	}
	$classes[] = $args->menu_class . '__item';

	$classes = str_replace(array('current_page_parent', 'current_page_ancestor'), $args->menu_class . '__item--parent', $classes);
	$classes = str_replace('current-menu-item', $args->menu_class . '__item--active', $classes);

	return $classes;
}

add_filter('nav_menu_css_class' , 'my_nav_special_class' , 10 , 3);

/** Add classes to wp_nav_menu <a> tags */
function my_nav_special_attribute($attributes, $item, $args){
	if(empty($args->menu_class)){
		$args->menu_class = 'site-nav';
	}
	$attributes['class'] = $args->menu_class . '__link';
	return $attributes;
}

add_filter('nav_menu_link_attributes' , 'my_nav_special_attribute' , 10 , 3);
