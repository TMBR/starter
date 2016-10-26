// TMBR Creative Agency
// Date: 6.27.2016

/**
 * Set up smooth scroll on anchor click
 *
 * @class      	SmoothScroll (name)
 * @return  	{constructor} init
 */
var SmoothScroll = function($) { // ----- static module

    var _init = function() {
    	$('a[href*="#"]:not([href="#"]).scroll-to').on('click','', function( e ) {
			e.preventDefault();

			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') || location.hostname == this.hostname) {
				var target = $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) +']');

				if (target.length) {
					$('html,body').animate(
						{ scrollTop: target.offset().top },
						{ duration: 600, easing:'easeOutCubic'}
					);
					return false;
				}

			}

		});
    };

    return {
        init: _init
    };
}(jQuery);