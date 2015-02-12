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
			
			self.mobileMenu.init();
			
			self.socialShare.init();
			
		},
		
		// Hide elements hidden with CSS to make it easier to show/hide them with JavaScript (if needs be)
		jsHide: function(){
		
			$('.js-hidden').hide().removeClass('js-hidden');
			
		},
		
		// Allow a menu to be shown/hidden with the click of a button
		mobileMenu: {
			
			$nav: $('.site-nav'),
			$button: $('.site-nav-button'),
			classes: {
				active: 'site-nav-active'	
			},
			
			init: function(){
				var self = this;
				
				if(self.$nav.length === 0 || self.$button.length === 0){
					return;
				}	
					
				self.$button.click(function(e){
					e.preventDefault();
					self.toggleMenu();
				});
			},
			
			// Note: we're just gonna toggle classes with JS and 
			// we'll use CSS to display/animate stuff
			toggleMenu: function(){
				var self = this;
				$('body').toggleClass(self.classes.active);
			}
			
		},
		
		// Open social share (e.g. Twitter/Facebook) links in a new small window
		socialShare: {
			
			init: function(){
				var self = this;

				$('a[data-share]').click(function(e){
					e.preventDefault();
					self.popUp($(this).attr('href'));
				});
			},
			
			popUp: function(url){
				
				var newWindow,
					height = 340,
					width = 675,
					left = (screen.width/2)-(width/2),
					top = (screen.height/2)-(height/2);
				
				newWindow = window.open(url, 'Share', 'height=' + height + ',width=' + width + ',top=' + top + ',left=' + left);
				
				if(window.focus){
					newWindow.focus();
				}	
			}
		}

	};
	
	window.WordPressTheme.init();

}(jQuery));