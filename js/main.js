/**
 *	WordPress Theme Global scripting
 *	@author	Phil Thompson
 *	global jQuery
 */
 
 

(function ($) {

	"use strict";

	var WordPressTheme = {
	
	
		config: {
			
		},
		
		// Functions to run onload
		onReady: function(){
			
			var self = this;
			
			
			self.jsHide();
			
			self.mobileMenu();
			
		},
		
		jsHide: function(){
		
			$('.js-hidden').hide().removeClass('js-hidden');
			
		},
		
		// 
		mobileMenu: function(){
			
			var self = this,
				$nav = $('.site-nav'),
				$button = $('.site-nav-button');
				
			if($nav.length === 0 || $button.length === 0){
				return;
			}
				
				
			$button.click(function(e){
				e.preventDefault();
				$(this).toggleClass('active');
				$nav.toggleClass('active');
			});
			
			
		}
	

	};
	
	WordPressTheme.onReady();

}(jQuery));



// ConvertEntities - from l10n.js
function convertEntities(b){var d,a;d=function(c){if(/&[^;]+;/.test(c)){var f=document.createElement("div");f.innerHTML=c;return !f.firstChild?c:f.firstChild.nodeValue}return c};if(typeof b==="string"){return d(b)}else{if(typeof b==="object"){for(a in b){if(typeof b[a]==="string"){b[a]=d(b[a])}}}}return b};