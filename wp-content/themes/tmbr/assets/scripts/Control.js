// TMBR Creative Agency
// Author: michael.ross
// Date: 6.27.2016
// updated: 10.4.2016
//
// Doc - https://github.com/documentationjs/documentation/blob/master/docs/GETTING_STARTED.md

/**
 * This function is called at Document.ready()
 * @name Control
 * @private
 * @param {object} jQuery
 * @returns {object} Control + methods
 * @example Control.init();
*/
var Control = function($) { // ----- static module
    // private var(s)
    var sliderOptions = {
        selector:           ".flexslider",
        namespace:          "flex-",
        animation:          "slide",
        slideshow:          false, // auto play on load
        slideshowSpeed:     2000,
        animationSpeed:     500,
        pauseOnHover:       true,
        controlNav:         false, //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
        directionNav:       true, //Boolean: Create navigation for previous/next navigation? (true/false)
        prevText:           "Previous",
        nextText:           "Next",
        randomize:          false,
        touch:              true,
        video:              true
    }

    // private method(s)
    var _init = function() {

        Preloader.init();
        //Throttle.init();
        SmoothScroll.init();
        Animated.init();
        Slider.init(sliderOptions);
        SlickSlider.init();
        Lightbox.init();
    };

    // output/public
    return {
        init: _init
    };
}(jQuery);

/**
 * This function fires off Control.init();
*/
jQuery(document).ready(function() {
    Control.init();
});