<?php

/**
 *	Clean up WordPress admin area a bit by removing certain columns from the tables
 *	on the 'View All' Posts/Pages screens
 */

/** Remove Comments from Admin Area (remove this section of code if not needed) */
function my_admin_menu() {
	remove_menu_page('edit-comments.php');
}

add_action('admin_menu', 'my_admin_menu');

function remove_pages_count_columns($defaults){
	unset($defaults['comments']);
	unset($defaults['tags']);
	return $defaults;
}

add_filter('manage_pages_columns', 'remove_pages_count_columns');
add_filter('manage_posts_columns', 'remove_pages_count_columns');

/** Remove annoying "Robots Meta" columns that WP SEO puts in */
remove_filter('manage_page_posts_columns', array($wpseo_metabox, 'page_title_column_heading'), 10, 1);
remove_filter('manage_post_posts_columns', array($wpseo_metabox, 'page_title_column_heading'), 10, 1);
remove_action('manage_pages_custom_column', array($wpseo_metabox, 'page_title_column_content'), 10, 2);
remove_action('manage_posts_custom_column', array($wpseo_metabox, 'page_title_column_content'), 10, 2);

/**
 *	remove_WPSEO_columns
 *	Remove WordPress SEO's awful extra columns
 *	Note: You'll need one call for each Custom Post Type; WordPress 'out the box' just has 'post' & 'page'
 *	@param	array
 *	@return array
 */
function remove_WPSEO_columns($columns){
    unset($columns['wpseo-score']);
    //unset($columns['wpseo-title']); // This option is actually quite useful to see/know
    unset($columns['wpseo-metadesc']);
    unset($columns['wpseo-focuskw']);
    return $columns;
}

add_filter('manage_edit-post_columns', 'remove_WPSEO_columns');
add_filter('manage_edit-page_columns', 'remove_WPSEO_columns');
