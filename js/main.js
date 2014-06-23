/**
 *	WordPress Theme Global scripting
 *	@author	Phil Thompson
 */

/*jslint browser: true, devel: true, white: true, todo: true */

/*global requestAnimationFrame: true, Modernizr: true, smoothScroll: true */


// Create a global object we can reference
window.WordPressTheme = window.WordPressTheme || {};

(function ($) {

	"use strict";

	window.WordPressTheme = {

		config: {
			// Not used
		},
		
		// Functions to run onload - note we don't need $(document).ready(); because we include this script before </body>
		init: function(){
			
			var self = this;

			self.jsHide();
			
			self.mobileMenu();
			
		},
		
		// Hide elements hidden with CSS to make it easier to show/hide them with JavaScript (if needs be)
		jsHide: function(){
		
			$('.js-hidden').hide().removeClass('js-hidden');
			
		},
		
		// Allow a menu to be shown/hidden with the click of a button
		mobileMenu: function(){
			
			var $nav = $('.site-nav'),
				$button = $('.site-nav-button');
				
			if($nav.length === 0 || $button.length === 0){
				return;
			}	
				
			$button.click(function(e){
				e.preventDefault();
				// Note: we're just gonna toggle classes with JS and we'll use CSS to display/animate stuff
				$(this).toggleClass('active');
				$nav.toggleClass('active');
			});
			
		}

	};
	
	window.WordPressTheme.init();

}(jQuery));