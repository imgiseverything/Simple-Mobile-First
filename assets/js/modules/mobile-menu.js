/**
 *	WordPress Theme Global scripting
 *	@author	Phil Thompson
 */

/*jslint browser: true, devel: true, white: true, todo: true */


// Create a global object we can reference
window.WordPressTheme = window.WordPressTheme || {};

(function ($) {

	"use strict";

	window.WordPressTheme.mobileMenu = {

		/**
		 * Vars
		 */
		$body: $('body'),
		$nav: $('.site-nav'),
		$button: $('.site-nav-button'),
		classes: {
			active: 'site-nav-active'
		},

		/**
		 * Functions to kick start everything
		 */
		init: function(){

			var self = this;

				if(self.$nav.length === 0 || self.$button.length === 0){
					return;
				}

				self.$button.click(function(e){
					self.clickHandler(e);
				});

		},

		/**
		 *
		 */
		clickHandler: function (e) {

			var self = this;

			e.preventDefault();
			self.toggleMenu();

		},

		/**
		 * Show/Hide the menu
		 * Note: we're just gonna toggle classes with JS and
		 * we'll use CSS to display/animate stuff
		 */
		toggleMenu: function(){

			var self = this;
			self.$body.toggleClass(self.classes.active);

		}

	};

	window.WordPressTheme.mobileMenu.init();

}(jQuery));