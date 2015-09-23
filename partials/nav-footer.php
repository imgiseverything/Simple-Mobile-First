<?php
/**
 * Site Nav (for the Footer)
 * Uses wp_page_menu (which sucks) by defauylt but wp_nav_menu if the user
 * creates their own menu.
 */

if(has_nav_menu('primary')):
	wp_nav_menu(array(
		'container'				=> '', 
		'container_class' => '', 
		'menu_class'			=> 'site-footer__nav', 
		'theme_location'	=> 'footer'
	));
else:
	wp_page_menu(array(
	'depth'				=> 2, 
	'menu_class'	=> 'site-footer__nav'
	));
endif;
