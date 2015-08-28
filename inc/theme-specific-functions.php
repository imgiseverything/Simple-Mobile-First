<?php

// Remove some JavaScript files and remove ?v=x.x on asset files like JS and CSS
add_filter( 'wp_default_scripts', 'dequeue_jquery_migrate' );


// Seriously why is jQuery migrate included so often by plugins/WordPress?!
function dequeue_jquery_migrate( &$scripts){
	if(!is_admin()){
		$scripts->remove( 'jquery');
		$scripts->add( 'jquery', false, array( 'jquery-core' ) );
	}
}

// Get rid of those ? params in static asset files
function remove_cssjs_ver( $src ) {
    if( strpos( $src, '?ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'remove_cssjs_ver', 10, 2 );
add_filter( 'script_loader_src', 'remove_cssjs_ver', 10, 2 );



/*add_filter( 'script_loader_tag', function ( $tag, $handle ) {
    return str_replace( ' src', ' async defer="defer" src', $tag );
}, 10, 2 );*/



// Remove emojis in WordPress on the front-end
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');