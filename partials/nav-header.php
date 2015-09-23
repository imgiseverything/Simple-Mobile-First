<?php
/**
 * Site Nav (for the Header)
 * Uses wp_page_menu (which sucks) by defauylt but wp_nav_menu if the user
 * creates their own menu.
 */
?>
<div class="mobile-only button site-nav-button" title="Show/hide menu">Menu</div>
<?php 
if(has_nav_menu('primary')):
	wp_nav_menu(array(
		'container'				=> '', 
		'container_class' => '', 
		'menu_class'			=> 'site-nav', 
		'theme_location'	=> 'primary'
	));
else:
	wp_page_menu(array(
	'depth'				=> 2, 
	'menu_class'	=> 'site-nav'
	));
endif;
