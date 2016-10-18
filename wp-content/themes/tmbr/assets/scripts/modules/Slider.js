// TMBR Creative Agency
// Date: 6.27.2016

// Dependent Upon
// - jQuery
// - UTIL
// - Slick.js
// 
// Module(s) (static)
// - Slider
//

var Slider = function() { // ----- static module

    // private method(s)
    var _init = function( options ) {

        $('.slick-slider').each( function() {
            $(this).slick( options );
        });
    };

    // output/public     
    return {
        init: _init
    };
}(jQuery)