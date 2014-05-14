<?php

// @see: https://codex.wordpress.org/TinyMCE_Custom_Styles

// Callback function to insert 'styleselect' into the $buttons array
function my_mce_buttons_2($buttons){
	array_unshift($buttons, 'styleselect');
	return $buttons;
}
add_filter('mce_buttons_2', 'my_mce_buttons_2');


// Callback function to filter the MCE settings
function my_mce_before_init_insert_formats($init_array){  
	// Define the style_formats array
	$style_formats = array(  
		// Each array child is a format with it's own settings 
		array(  
			'title' 	=> '.h1',  
			'block'		=> 'h2',  
			'classes' 	=> 'h1',
			'wrapper' 	=> false,
		),
		array(  
			'title' 	=> '.h2', 
			'block'		=> 'h2',   
			'classes' 	=> 'h h2',
			'wrapper' 	=> false,
		),
		array(  
			'title' 	=> '.h3', 
			'block'		=> 'h2',   
			'classes' 	=> 'h h3',
			'wrapper' 	=> false,
		),
		array(  
			'title' 	=> '.h4', 
			'block'		=> 'h2',   
			'classes' 	=> 'h h4',
			'wrapper' 	=> false,
		),
		array(  
			'title' 	=> '.h5',  
			'block'		=> 'h2',  
			'classes' 	=> 'h h5',
			'wrapper' 	=> false,
		),
		array(  
			'title' 	=> '.h6',  
			'block'		=> 'h2',  
			'classes' 	=> 'h h6',
			'wrapper' 	=> false,
		)
	);  
	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = json_encode($style_formats);  
	
	return $init_array;  
  
}

add_filter('tiny_mce_before_init', 'my_mce_before_init_insert_formats');  

