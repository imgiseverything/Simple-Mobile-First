<?php
/**
 * The Header for our theme.
 */
 
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
		<meta name="viewport" content="initial-scale=1.0">
		<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>">
		<!--[if lt IE 9]> <script src="<?php echo get_template_directory_uri(); ?>/js/respond.js"></script> <![endif]-->
<?php

		// JavaScript files - load at the bottoms where possible
		$load_at_bottom = true;
		
		// jQuery
		wp_deregister_script('jquery');

		wp_enqueue_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js', null, null, true);
		
		// Site specific scripts
		wp_enqueue_script('global', get_template_directory_uri() . '/assets/js/simple-mobile-first.js', array('jquery'), null, $load_at_bottom);
		
		// End JavaScript files

		wp_head();
	
?>
</head>
<body <?php body_class(); ?>>
<div class="site-container">
	<header class="group site-header">
	
		<div role="banner" class="group">
			<?php $heading_tag = (is_home() || is_front_page()) ? 'h1' : 'div'; ?>
			<<?php echo $heading_tag; ?> class="site-header__logo">
				<a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>"><?php include('assets/images/logo.svg'); ?> <span class="visuallyhidden"><?php bloginfo('name'); ?></span></a>
			</<?php echo $heading_tag; ?>>
		</div>
	
		<nav role="navigation" class="group">
			<?php include('partials/nav-header.php'); ?>
		</nav>
			
	</header>

	<div id="content" class="group site-content">
