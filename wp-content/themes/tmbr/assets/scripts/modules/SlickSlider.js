// TMBR Creative Agency
// Author: galen.strasen
// Date: 7.19.2016
// Dependent Upon
// - jQuery
// - slick slider
// Module(s) (static)
// - slick slider
//
var SlickSlider = function(element) { // ----- static module

    var _init = function() {
        $('.js-slider').slick({
            dots: true,
            arrows: false
        });
        $('.js-lazy').slick({
            lazyLoad: 'ondemand',
            dots: true,
            arrows: false
        });
        $('.js-slider-auto').slick({
            autoplay: true,
            autoplaySpeed: 5000,
            dots: true,
            arrows: false
        });
        $('.js-adaptive-slider').slick({
            autoplay: true,
            autoplaySpeed: 5000,
            dots: true,
            arrows: false,
            adaptiveHeight: true
        });
    };
    // output/public
    return {
        init: _init
    };
}(jQuery);