// TMBR Creative Agency
// Date: 6.27.2016

/**
 * Throttle
 *
 * @class      Throttle (name)
 * @param      {Function}  $
 * @return     {Constructor} init
 */

var Throttle = function($) { // ----- static module
    // private var(s)
    var throttleTimeOut = 50; //milliseconds before triggering function again

    // private method(s)
    var _init = function() {
        // Window Scroll functions
        $(window).on('scroll', _throttle(function(){

           var  scrollTop = $(window).scrollTop(),
                screensize = $('.js-doc-nav-wrapper').height() - 50,
                distance = (screensize - scrollTop);

            if ( distance < 0 ) {
                $('.navbar-default').addClass("js-nav-scroll-white");
            } else {
                $('.navbar-default').removeClass("js-nav-scroll-white");
            }

        }, throttleTimeOut));

        // Window Resize Functions
        $(window).on('resize', _throttle(function(){
            /* do your normal resize stuff here, but it'll be
             * more-reasonably controlled, so as to not peg
             * the host machine's processor */
        }, throttleTimeOut));

        console.log("Throttle.init");
    };


    // output/public
    return {
        init: _init
    };
}(jQuery);
