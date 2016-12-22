/**
 *	WordPress Theme Global scripting
 *	@author	Phil Thompson
 */

/*jslint browser: true, devel: true, white: true, todo: true */


// Create a global object we can reference
window.WordPressTheme = window.WordPressTheme || {};

(function ($) {

	"use strict";

	window.WordPressTheme.socialShare = {


		/**
		 * Functions to kick start everything
		 */
		init: function(){

			var self = this;

			$('a[data-share]').on('click', function(e){
				self.clickHandler(e);
			});

		},

		/**
		 *
		 */
		clickHandler: function(e){

			var self = this;

			e.preventDefault();
			self.popUp($(e.currentTarget).attr('href'));

		},

		/**
		 *	Open the social site's URL in a new window
		 */
		popUp: function(url){

			var newWindow,

					// Set dimensions for the window
					height = 340,
					width = 675,

					// Use the following values to centralise the new window
					left = (screen.width/2)-(width/2),
					top = (screen.height/2)-(height/2);

			newWindow = window.open(url, 'Share', 'height=' + height + ',width=' + width + ',top=' + top + ',left=' + left);

			if(window.focus){
				newWindow.focus();
			}

		}

	};

	window.WordPressTheme.mobileMenu.init();

}(jQuery));