// TMBR Creative Agency
// Date: 6.27.2016

// Dependent Upon
// - jQuery
// - Util
// - Constants
// Module(s) (static)
// - Throttle
//
//

var Throttle = function($) { // ----- static module
    // private var(s)
    var throttleTimeOut = 50; //milliseconds before triggering function again

    // private method(s)
    var _init = function() {
        // Window Scroll functions
        // $(window).on('scroll', _throttle(function(){
        //     if ( $(window).scrollTop() > 20) {
        //       $('body').addClass('scrolled');
        //     } else {
        //       $('body').removeClass('scrolled');
        //     }
        // }, throttleTimeOut));

        // Window Resize Functions
        $(window).on('resize', _throttle(function(){
            /* do your normal resize stuff here, but it'll be
             * more-reasonably controlled, so as to not peg
             * the host machine's processor */
        }, throttleTimeOut));

    };


    // output/public
    return {
        init: _init
    };
}(jQuery);
