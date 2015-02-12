<?php

/**
 *	extend_body_class
 *	Add the page slug to the <body class=""> values for  mo' better CSS styling
 *	If the URL is /directory/sub-directory/page then add:
 *	directory, subdirectory and page values to the classes list
 *	@param	array list of current classes
 *	@return	array list of current classes + new ones
 */
add_filter('body_class', 'extend_body_class');
function extend_body_class($classes) {

	$url = str_replace(array($_SERVER['QUERY_STRING'], '?'), '', $_SERVER['REQUEST_URI']);
	$url_parts = explode('/', $url);
	
	foreach($url_parts as $key){
		if(!is_numeric($key) && strlen($key) > 0){
			$classes[] = trim($key);
		}
	}

	return $classes; 
}

/**
 *	is_ajax
 *	Is the page request an AJAX call? Use this to determine
 *	what content to show e.g. hide get_header() in a template
 *	@usage	if(is_ajax() !== true): get_header(); endif;
 *	@return	boolean
 */
function is_ajax(){

	$ajax = false;	
	
	if(
		!empty($_SERVER['HTTP_X_REQUESTED_WITH']) 
		&& $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'
	){
		$ajax = true;
	}
	
	return $ajax;
}

/**
 *	get_parameter
 *	Display array parameters on the page and avoid
 *	php errors for missing array keys
 *
 *	@param 	string $key
 *	@return string $value;
 *	@usage	echo get_parameter($_POST, 'foo', 'bar'); or go deep
 *			get_parameter($_POST, 'foo', get_parameter($_GET, 'foo', 'bar'));
 */
function get_parameter($object, $key, $default = ''){

	$value = $default;
	
	if(isset($object[$key])){
		$value = $object[$key];
	}
	
	return $value;
}

/**
 *	add_slug_class_to_menu_item
 *	Add page slug to the class on relevant menu items for easier CSS styling
 *	@param	array
 *	@return	array
 */
function add_slug_class_to_menu_item($output){
	$ps = get_option('permalink_structure');
	if(!empty($ps)){
		$idstr = preg_match_all('/menu-item-(\d+)/', $output, $matches);
		foreach($matches[1] as $mid){
			$id = get_post_meta($mid, '_menu_item_object_id', true);
			$slug = basename(get_permalink($id));
			$output = preg_replace('/menu-item-' . $mid . '">/', 'menu-item-' . $mid . ' menu-item-' . $slug. '">', $output, 1);
		}
	}
	
	$blogurl = str_replace('http://', '', get_bloginfo('siteurl'));
	
	$output = str_replace('menu-item-' . $blogurl, 'menu-item-home', $output);

	return $output;
}

add_filter('wp_nav_menu', 'add_slug_class_to_menu_item');

add_filter('wp_nav_menu', 'add_slug_class_to_menu_item');

/**
 *	urlify()
 *	CREATE URL-friendly strings
 *	1. Strip everything but letters, numbers and spaces from the title
 *	2. Replace spaces and underscores with dashes
 *	3. Make lowercase
 *	@param	string
 *	@return	string
 */
function urlify($string){

	$string = preg_replace("/[^A-Za-z0-9 ]/", '', trim($string));
	$string = str_replace(array(" ", "_"), '-', $string);
	$string = strtolower($string);	
		
	return $string;
}



/**
 *	formatted_telephone_number
 *	Convert +44 (0)xxx xxx xxxx formatted numbers to +44xxxxxxxxxx
 *	@param	string
 *	@return	string
 */
function formatted_telephone_number($telephone_number){
	$telephone_number = preg_replace("/[^0-9]/", '', trim($telephone_number));
	return $telephone_number;
}

/**
 *	fb_move_admin_bar
 *	Jeez how annoying is that admin toolbar at the top of the page sometimes?
 *	This moves it to the bottom
 */
function move_admin_bar() {
	
	echo '
	<style>
	html.js, html.no-js{ margin-top: 0 !important; }
	body.admin-bar{
        padding-bottom: 46px;
    }
    
    #wpadminbar {
        top: auto !important;
        bottom: 0;
    }
    #wpadminbar .quicklinks>ul>li {
        position:relative;
    }
    #wpadminbar .ab-top-menu>.menupop>.ab-sub-wrapper {
        bottom:46px;
    }
    
    
    @media screen and ( max-width: 782px ) {
    
    	body.admin-bar{
	   	 padding-bottom: 46px;
	   	}
    	 #wpadminbar .ab-top-menu>.menupop>.ab-sub-wrapper
    	 	bottom: 46px;
    	 }
    }
</style>';
    
}
// on frontend area
if(is_admin_bar_showing()){
	add_action('wp_head', 'move_admin_bar');
}


/**
 * Stop WordPress SEO making their metabox such a high priority.
 */
add_filter('wpseo_metabox_prio','lower_wpseo_metabox', 10);
function lower_wpseo_metabox($priority) {
	$priority = 'low';
	return $priority;
}

/**
 *	convert_wp_pagenavi_html_output
 *	make wp-pagenavi's (which is awesome btw), less than awesome HTML output more awesome
 *	@see http://calebserna.com/bootstrap-wordpress-pagination-wp-pagenavi/
 */
//attach our function to the wp_pagenavi filter
add_filter('wp_pagenavi', 'convert_wp_pagenavi_html_output', 10, 2);
function convert_wp_pagenavi_html_output($html) {
    $pagination = '';
  
    //wrap a's and span's in li's
    $pagination = str_replace('<div', '', $html);
    $pagination = str_replace("class='wp-pagenavi'>", '', $pagination);
    $pagination = str_replace('<a', '<li><a', $pagination);
    $pagination = str_replace('</a>', '</a></li>', $pagination);
    $pagination = str_replace('<span', '<li><span', $pagination);  
    $pagination = str_replace('</span>', '</span></li>', $pagination);
    $pagination = str_replace('</div>', '', $pagination);
  
    return '<ul class="pagination">' . $pagination . '</ul>';      
}

