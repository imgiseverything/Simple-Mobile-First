<?php
/**
 * The Header for our theme.
 */
 
$last_updated = '23072013'; // <- cache buster. Change this after updating CSS or JavaScript files
 
?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title><?php wp_title(''); ?></title>
		<script>document.documentElement.className = document.documentElement.className.replace(/\bno-js\b/,'js');</script>
		<!--[if lt IE 9]> <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script> <![endif]-->
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<meta name="viewport" content="width=device-width">
		<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>?<?php echo $last_updated; ?>">
		<!--[if lt IE 9]> <script src="<?php echo get_template_directory_uri(); ?>/js/respond.js"></script> <![endif]-->
<?php
		
		
		// JavaScript files - load at the bottoms where possible
		$load_at_bottom = true;
		
		// jQuery
		wp_enqueue_script('jquery');
		
		// Site specific scripts
		wp_enqueue_script('global', get_template_directory_uri() . '/js/main.js', array('jquery'), $last_updated, $load_at_bottom);
		
		// End JavaScript files

		wp_head();
	
?>
</head>
<body <?php body_class(); ?>>
<div class="site-container">
	<header class="group site-header">
	
		<div role="banner" class="group">
			<?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; ?>
			<<?php echo $heading_tag; ?> class="logo ir">
				<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
			</<?php echo $heading_tag; ?>>
		</div>
	
		<nav role="navigation" class="group">
			<div class="mobile-only button site-nav-button" title="Show/hide menu">Menu</div>
			<?php wp_nav_menu( array( 'container' => '', 'container_class' => '', 'menu_class' => 'site-nav', 'theme_location' => 'primary' ) ); ?>
		</nav>
			
	</header>

	<div id="content" class="group site-content">
