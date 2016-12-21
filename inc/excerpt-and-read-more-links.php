<?php


/**
 *	simple_mobile_first_continue_reading_link
 *	Returns a "Continue Reading" link for excerpts
 *	For accesibility this reads Continue Reading Post Title with Post Title
 *	wrapped in a span tag and a class which CSS defines will be read by screenreaders/search
 *	engines but *won't* be visibly shown on the page
 *	@return string "Continue Reading" link
 */
function simple_mobile_first_continue_reading_link(){
	return '</p><p><a href="'. get_permalink() . '" class="button button-read-more">' . 'Continue reading <span class="visuallyhidden">' . get_the_title() . '</span>' . '</a></p>';
}

/**
 *	simple_mobile_first_auto_excerpt_more
 *	Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and simple_mobile_first_continue_reading_link().
 *
 *	To override this in a child theme, remove the filter and add your own
 *	function tied to the excerpt_more filter hook.
 *
 *	@param string
 *	@return string An ellipsis
 */
function simple_mobile_first_auto_excerpt_more($more){
	return ' &hellip;' . simple_mobile_first_continue_reading_link();
}

add_filter( 'excerpt_more', 'simple_mobile_first_auto_excerpt_more' );

/**
 *	simple_mobile_first_custom_excerpt_more
 *	Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 *	To override this link in a child theme, remove the filter and add your own
 *	function tied to the get_the_excerpt filter hook.
 *
 *	@param	string
 *	@return	string Excerpt with a pretty "Continue Reading" link
 */
function simple_mobile_first_custom_excerpt_more($output){
	if(has_excerpt() && ! is_attachment()) {
		$output .= simple_mobile_first_continue_reading_link();
	}
	return $output;
}

add_filter('get_the_excerpt', 'simple_mobile_first_custom_excerpt_more');
