var Slider = (function($) {
	var slider = {
		init : function() {

			$(document).ready(function() {

			  $('#fullscreen_slider').flexslider({
			    animation: "slide",
			    slideshow: false, // auto play on load
			    slideshowSpeed: 4000,
				animationSpeed: 600,
				pauseOnHover: true,
				controlNav: true, //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
				directionNav: true, //Boolean: Create navigation for previous/next navigation? (true/false)
				prevText: "Previous",
				nextText: "Next"
			  });

			});

		}
	}
	return slider;
})(jQuery);
