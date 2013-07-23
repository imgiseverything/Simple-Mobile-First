<?php
/**
 * Theme functions and definitions
 * @package WordPress
 */


/** Tell WordPress to run nocruft_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'theme_setup' );

if ( ! function_exists( 'theme_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override nocruft_setup() in a child theme, add your own nocruft_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_editor_style() To style the visual editor.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 */
function theme_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
	//add_theme_support( 'post-formats', array( 'aside', 'image', 'video' ) );

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation' ),
	) );
	


	// Add a custom post type
	if (class_exists('IMGCustomPostTypes') === true ) {
	
		// Example custom post type
		$cpt_example = new IMGCustomPostTypes();
		$cpt_example->customFields = array('example_foo', 'example_bar', 'example_yes_or_no_boolean', 'example_extra_information_textarea', 'example_start_date');
		$cpt_example->namingConventions = array(
			'name' 				=> 'example',
			'singular' 			=> 'Example',
			'plural'			=> 'Examples',
			'slug'				=> 'example',
			'tag_name'			=> 'example_tags',
			'tag_singular'		=> 'Example tag',
			'tag_plural'		=> 'Example tags'
		);
		$cpt_example->supports = array('title', 'editor', 'excerpt', 'thumbnail', 'page-attributes'/*, 'comments'*/);
		
	}
	

}
endif;


// Remove stupid WP sections like links
add_action( 'admin_menu', 'my_admin_menu' );
function my_admin_menu() {
	//remove_menu_page('edit-comments.php');
}


function remove_pages_count_columns($defaults) {
	unset($defaults['comments']);
	unset($defaults['tags']);
	return $defaults;
}

add_filter('manage_pages_columns', 'remove_pages_count_columns');
add_filter('manage_posts_columns', 'remove_pages_count_columns');





// remove annoying "Robots Meta" columns that WP SEO puts in
remove_filter('manage_page_posts_columns', array($wpseo_metabox, 'page_title_column_heading'), 10, 1);
remove_filter('manage_post_posts_columns', array($wpseo_metabox, 'page_title_column_heading'), 10, 1);
remove_action('manage_pages_custom_column', array($wpseo_metabox, 'page_title_column_content'), 10, 2);
remove_action('manage_posts_custom_column', array($wpseo_metabox, 'page_title_column_content'), 10, 2);

// Remove WordPress SEO's awful extra columns
add_filter('manage_edit-post_columns', 'tcz_remove_WPSEO_columns');
add_filter('manage_edit-page_columns', 'tcz_remove_WPSEO_columns');
// you'll need one call for each CPT; so for vanilla WP has 'post' & 'page'

function tcz_remove_WPSEO_columns($columns){
    unset($columns['wpseo-score']);
    unset($columns['wpseo-title']);
    unset($columns['wpseo-metadesc']);
    unset($columns['wpseo-focuskw']);
    return $columns;
}


/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 */
function nocruft_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'nocruft_page_menu_args' );

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @return int
 */
function nocruft_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'nocruft_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @return string "Continue Reading" link
 */
function nocruft_continue_reading_link() {
	return '</p><p><a href="'. get_permalink() . '" class="button button-read-more">' . 'Continue reading <span class="visuallyhidden">' . get_the_title() . '</span>' . '</a></p>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and nocruft_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @return string An ellipsis
 */
function nocruft_auto_excerpt_more( $more ) {
	return ' &hellip;' . nocruft_continue_reading_link();
}
add_filter( 'excerpt_more', 'nocruft_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function nocruft_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= nocruft_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'nocruft_custom_excerpt_more' );

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Twenty Ten's style.css. This is just
 * a simple filter call that tells WordPress to not use the default styles.
 *
 * @since Twenty Ten 1.2
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Deprecated way to remove inline styles printed when the gallery shortcode is used.
 *
 * This function is no longer needed or used. Use the use_default_gallery_style
 * filter instead, as seen above.
 *
 * @deprecated Deprecated in Twenty Ten 1.2 for WordPress 3.1
 *
 * @return string The gallery style filter, with the styles themselves removed.
 */
function nocruft_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
// Backwards compatibility with WordPress 3.0.
if ( version_compare( $GLOBALS['wp_version'], '3.1', '<' ) )
	add_filter( 'gallery_style', 'nocruft_remove_gallery_css' );

if ( ! function_exists( 'nocruft_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own nocruft_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 */
function nocruft_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		
		<div class="comment-body"><?php comment_text(); ?></div>
		
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf('%s ', sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div>
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation">Your comment is awaiting moderation.</em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata">
			<?php
				/* translators: 1: date, 2: time */
				printf( '%1$s at %2$s', get_comment_date(),  get_comment_time() ); ?><?php edit_comment_link(  '(Edit)', ' ' ); ?>
		</div>

	</div>

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p>Pingback: <?php comment_author_link(); ?><?php edit_comment_link( '(Edit)', ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;
/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override nocruft_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @uses register_sidebar
 */
function nocruft_widgets_init() {
	// Area 1, located at the top of the sidebar.
	/*register_sidebar( array(
		'name' => 'Primary Widget Area',
		'id' => 'primary-widget-area',
		'description' =>  'The primary widget area',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => 'Secondary Widget Area',
		'id' => 'secondary-widget-area',
		'description' =>  'The secondary widget area',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 3, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => 'First Footer Widget Area',
		'id' => 'first-footer-widget-area',
		'description' => 'The first footer widget area',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );*/

}
/** Register sidebars by running nocruft_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'nocruft_widgets_init' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * This function uses a filter (show_recent_comments_widget_style) new in WordPress 3.1
 * to remove the default style. Using Twenty Ten 1.2 in WordPress 3.0 will show the styles,
 * but they won't have any effect on the widget in default Twenty Ten styling.
 *
 */
function nocruft_remove_recent_comments_style() {
	add_filter( 'show_recent_comments_widget_style', '__return_false' );
}
add_action( 'widgets_init', 'nocruft_remove_recent_comments_style' );

if ( ! function_exists( 'nocruft_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 */
function nocruft_posted_on() {
	printf( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s',
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>', get_author_posts_url( get_the_author_meta( 'ID' ) ), sprintf( esc_attr( 'View all posts by %s', get_the_author() ), get_the_author())));
}
endif;

if ( ! function_exists( 'nocruft_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 */
function nocruft_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. '  );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. ' );
	} 
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;





/**
*	extend_body_class
* 	Add page slug to the <body class=""> values for  mo' better CSS styling
*	If the URL is /directory/sub-directory/page then add:
*	directory, subdirectory and page values to the classes list
*	@param	array list of current classes
*	@return	array list of current classes + new ones
*/
add_filter( 'body_class', 'extend_body_class' );
function extend_body_class( $classes ) {

	$url = str_replace(array($_SERVER['QUERY_STRING'], '?'), '', $_SERVER['REQUEST_URI']);
	$url_parts = explode('/', $url);
	
	foreach($url_parts as $key){
		
		if(!is_numeric($key)){
			$classes[] = $key;
		}
	}
	
	
	// Home page yo
	if($url === '/'){
		$classes[] = 'home';
	}

   return $classes; 
}

/**
 *	is_ajax
 *	Is the page request an AJAX call? Use this to determine
 *	what content to show e.g. hide get_header() in a template
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
 *	@usage	echo get_parameter($_POST, 'foo', 'bar'); or go deep yo
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
 *	mo_better_archives
 *	Grab archives month/years
 *	@param	string 	CSS class attribute value
 *	@param	string 	prefix for the blog e.g. blog or news or 
 *					whatever the slug is for your index.php template
 *	@return string 	html <li> values - note no <ul>
 *	@usage	echo '<ul>' . mo_better_archives('active', 'blog'); . '</ul>';
 */ 
function mo_better_archives($class, $blog_prefix = 'blog'){

	global $wpdb;

	
	$now = date('Y');
	
	// TODO get another year's date if we're on it
	if(is_archive()){
		$now = get_the_date( 'Y' );
	}
	
	
	// Massive SQL query that grabs months/years where a post has been published
	$query = "
	SELECT COUNT(ID) posts, YEAR(post_date) y, MONTH(post_date) m 
	FROM  `{$wpdb->posts}`
	WHERE `post_status` = 'publish'
	AND `post_type` = 'post'
	GROUP BY y, m
	HAVING y = {$now}
	UNION
	SELECT COUNT(ID), YEAR(post_date) y, 0
	FROM `{$wpdb->posts}`
	WHERE `post_status` = 'publish'
	AND `post_type` = 'post'
	GROUP BY y
	HAVING y <= YEAR(NOW())
	ORDER BY y DESC, m DESC;
	";
			
	//echo $query;
	
	$archives = $wpdb->get_results($query, "ARRAY_A");
	
	// Put archives into multi-dimensional arrays so each year ahs it's children in it
	
	$archives_size = sizeof($archives);
	for($i = 0; $i < $archives_size; $i++){
	
		if(!is_array($archives[$archives[$i]['y']])){
			$archives[$archives[$i]['y']] = array('y' => $archives[$i]['y']);
		}
	
	
		if($archives[$i]['m'] > 0){
			$archives[$archives[$i]['y']][] = $archives[$i];
			unset($archives[$i]);
		} else{
			unset($archives[$i]);
		}
		
		
	}
	


	// Sift through that there above array and create gorgeous HTML <li>s and child <li>s
	$list = '';

	foreach($archives as $archive){
	
		$class = (is_archive() && get_the_date( 'Y' ) == $archive['y']) ? ' class="current_page_item"' : '';  
		$list .= '<li' . $class. '><a href="/' . $blog_prefix. '/' . $archive['y']. '/0">' . $archive['y']. '</a>';
		
		if(!empty($archives[$archive['y']][0])){ 
		
			$list .= '<ul>';

			$i = 0; 
			foreach($archives[$archive['y']] as $month){ 
				if($i > 0){ 
					$class_x = (is_archive() && is_month() && get_the_date( 'Y' ) == $archive['y'] && get_the_date( 'm' ) == $month['m']) ? ' class="current_page_item"' : ''; 
			

					$list .= '<li' . $class_x. '><a href="/' . $blog_prefix. '/' . $archive['y']. '/' . str_pad($month['m'], 2, '0', STR_PAD_LEFT). '/">' . date('F', mktime(0, 0, 0, $month['m'], 1, $archive['y'])) . '</a></li>';
			
				} // end if;
				
				$i++; 
			} // end foreach

			$list .= '</ul>';
			
		} // end if
		
	$list .= '</li>';
	
	} // end foreach
	

	
	return $list;
	
}


function add_slug_class_to_menu_item($output){
	$ps = get_option('permalink_structure');
	if(!empty($ps)){
		$idstr = preg_match_all('/<li id="menu-item-(\d+)/', $output, $matches);
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






/**
 *	urlify()
 *	CREATE URL-friendly strings
 */
function urlify($string){

	// Strip everything but letters, numbers and spaces from the title
	$string = preg_replace("/[^A-Za-z0-9 ]/", "", trim($string));
	// Replace spaces and underscores with dashes
	$string = str_replace(array(" ", "_"), '-', $string);
	// Make lowercase
	$string = strtolower($string);	
		
	return $string;
}