/**
 *	WordPress Theme Global scripting
 *	@author	Phil Thompson
 */

/*jslint browser: true, devel: true, white: true, todo: true */


// Create a global object we can reference
window.WordPressTheme = window.WordPressTheme || {};

(function ($) {

	"use strict";

	window.WordPressTheme.utils = {

		/**
		 * Functions to kick start everything
		 */
		init: function(){

			var self = this;

			self.jsHide();

		},

		/**
		 * Hide elements hidden with CSS to make it easier
		 * to show/hide them with JavaScript (if needs be)
		 */
		jsHide: function(){

			$('.js-hidden').hide().removeClass('js-hidden');

		}

	};

	window.WordPressTheme.utils.init();

}(jQuery));
