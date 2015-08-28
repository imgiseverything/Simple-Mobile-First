// Scroll user down the page
var smoothScroll = function(xCoordParam, scrollSpeed){
	
	"use strict";
		
	var xCoord = xCoordParam || 0;
	
	var easeOutQuad = function (x, t, b, c, d) {
		return -c *(t/=d)*(t-2) + b;
	};

	if(scrollSpeed > 1){
		jQuery('html, body').stop(true, true).animate({
			scrollTop: xCoord
		}, scrollSpeed, easeOutQuad);
	} else{
		jQuery(window).scrollTop(xCoord);
	}
};
