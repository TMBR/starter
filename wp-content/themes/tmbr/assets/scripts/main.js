// Mobile device detection
var ismobile = (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent));



(function($) {

	/* MODULES SET UP
	-----------------*/

	// Set up Sliders
	// Slider.init();


	if(ismobile == true){
		$('body').addClass('mobile');
	} else {
		// non mobile actions
		// new WOW().init();
	}

	// wait for full site to load before transition fires
	$(window).on('load', function() {
	  // Fade in page content and animation
	  // $("#site-wrapper").animate({"opacity": "1"}, 1000);

	}); // END window .load

	// DOC Ready
	$(function() {

		/* SMOTH SCROLL TO ANCHOR TAGS */
		/*
		$('a[href*=#]:not([href=#])').on('click','', function( e ){
		      e.preventDefault();
		    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
		        || location.hostname == this.hostname) {

		        var target = $(this.hash);
		        target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
		           if (target.length) {
		             $('html,body').animate(
		                {scrollTop: target.offset().top},
		                {duration: 600, easing:'easeOutCubic'});
		            return false;
		        }
		    }
		});
		*/


	}); // END Doc Ready



	var throttleTimeOut = 200; //milliseconds before triggering function again
	// Window scroll functions
	$(window).on('scroll', _throttle(function(){
		/* do your normal scroll stuff here, but it'll be
		 * more-reasonably controlled, so as to not peg
		 * the host machine's processor */
	}, throttleTimeOut));


})(jQuery);
