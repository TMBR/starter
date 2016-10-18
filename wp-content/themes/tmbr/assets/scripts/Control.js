// TMBR Creative Agency
// Author: michael.ross
// Date: 6.27.2016

// Dependent Upon
// - jQuery
// Module(s) (static)
// - Control
//

var Control = function($) { // ----- static module
    // private var(s)

    var SlickOptions = {
        dots: false,
        arrows: true,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        adaptiveHeight: true,
        lazyLoad: 'ondemand',
        autoplay: true,
        autoplaySpeed: 5000,
    };

    // private method(s)
    var _init = function() {

        MobileDetect.detect();
        Preloader.init();
        SmoothScroll.init();
        Animated.init();
        Slider.init( SlickOptions );
        SlickSlider.init();
        Lightbox.init();
        NavtoSelectList.init();
        SpeakerPair.init();
        ProductCatOffset.init();
        //Roadblock.init();
    };

    // output/public
    return {
        init: _init
    };
}(jQuery);


/* Fire off the doc ready */
jQuery( document ).ready(function() {
    Control.init();
});