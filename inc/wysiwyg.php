<?php
/**
 * Remove unwanted buttons from Tiny MCE to stop users breaking the layout
 * Add a drop down of custom classes which style the copy.
 * Make sure they are mirrored in an editor-style.css file in the theme root
 * @see: https://codex.wordpress.org/TinyMCE_Custom_Styles
 */

/** This theme styles the visual editor with editor-style.css to match the theme style */
add_editor_style();

/** Edit first row of buttons */
function my_mce_buttons($buttons){
	unset($buttons[2]); // strikethrough
	unset($buttons[5]); // blockquote
	unset($buttons[6]); // hr
	unset($buttons[7]); // left align
	unset($buttons[8]); // centre align
	unset($buttons[9]); // right align
	unset($buttons[12]); // read more tag
	return $buttons;
}

add_filter('mce_buttons', 'my_mce_buttons');

/** Edit second row of buttons */
function my_mce_buttons_2($buttons){
	//print_r($buttons);
	unset($buttons[1]); // underline
	unset($buttons[2]); // alignjustify
	unset($buttons[3]); // forecolor
	unset($buttons[7]); // outdent
	unset($buttons[8]); // indent
	array_unshift($buttons, 'styleselect');
	return $buttons;
}

add_filter('mce_buttons_2', 'my_mce_buttons_2');

/** Build custom styles drop-down */
function my_mce_before_init_insert_formats($init_array){
	// Define the style_formats array
	$style_formats = array(
		array(
			'title'	=>'Heading Sizes',
			'items'	=> array(
				array(
					'title'			=> 'Main headline/Page title',
					'selector'	=> '*',
					'classes'		=> 'alpha',
					'wrapper'		=> true
				),
				array(
					'title'			=> '32px (20px on mobile)',
					'selector'	=> '*',
					'classes'		=> 'beta',
					'wrapper'		=> true
				),
				array(
					'title'			=> '28px (18px on mobile)',
					'selector'	=> '*',
					'classes'		=> 'gamma',
					'wrapper'		=> true
				),
				array(
					'title'			=> '20px (16px on mobile)',
					'selector'	=> '*',
					'classes'		=> 'delta',
					'wrapper'		=> true
				),
				array(
					'title'			=> '18px (16px on mobile)',
					'selector'	=> '*',
					'classes'		=> 'epsilon',
					'wrapper'		=> true
				),
				array(
					'title'			=> '14px (12px on mobile)',
					'selector'	=> '*',
					'classes'		=> 'zeta',
					'wrapper'		=> true
				)
			)
		)
	);

	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = json_encode($style_formats);

	return $init_array;
}

add_filter('tiny_mce_before_init', 'my_mce_before_init_insert_formats');
