<?php
/**
 * Register custom post types.
 */
function registerCustomTypes(){
   /*
   register_post_type('content_block', array(
        'labels' => array(
            'name'               => 'Content Blocks',
            'singular_name'      => 'Content Block',
            'add_new_item'       => 'Add Block',
            'edit_item'          => 'Edit Block',
            'new_item'           => 'New Block',
            'view_item'          => 'View Block',
            'search_items'       => 'Search',
            'not_found'          => 'No block found',
            'not_found_in_trash' => 'No blocks found in Trash'
        ),

        'public' 			=> false,
        'show_ui' 			=> true,
        'show_in_admin_bar' => true,
        'menu_position' 	=> 20,
        'menu_icon' 		=> 'dashicons-tagcloud',
        'supports' 			=> array('title', 'editor', 'revisions')
    ));
  */
}

add_action('init', 'registerCustomTypes');
