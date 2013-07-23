/**
 *	WordPress Theme Global scripting
 *	@author	Phil Thompson
 *	global jQuery
 */
 
 

(function ($) {

	"use strict";

	var WordPressTheme = {

		config: {
			// Not used
		},
		
		// Functions to run onload - note we don't need $(document).ready(); because we include this script before </body>
		onReady: function(){
			
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
	
	WordPressTheme.onReady();

}(jQuery));