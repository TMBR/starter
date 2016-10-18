// TMBR Creative Agency
// Date: 6.27.2016

/**
 * Flexslider extension
 *
 * @class       Slider (name)
 * @return      {constructor}  Slider.init()
 * @return      {function} get get slider instance options
 * @return      {function} set set slider instance options
 * @param       {jquery} Element selector
 * @param       {string} [namespace="flex-"] any namespace
 * @param       {string} [animation="slide"] Select the sliding direction, "horizontal" or "vertical"
 * @param       {string} [easing="swing"] Determines the easing method used in jQuery transitions.
 * @param       {boolean} [animationLoop=true]
 * @param       {number} [startAt=0] Slide to start at.
 * @param       {number} [initDelay=0]
 * @prarm       {boolean} [slideshow=false] Flexslider 
 * @param       {number} [slideshowSpeed=4000] 
 * @param       {number} [animationSpeed=600]
 * @param       {boolean} [pauseOnHover=true]
 * @param       {boolean} [controlNav=true]
 * @param       {boolean} [directionNav=true]
 * @param       {string} [prevText="Previous"]
 * @param       {string} [nextText="Next"]
 * @param       {boolean} [randomize=true]
 * @param       {boolean} [touch=true]
 * @param       {boolean} [video=false]
 * @param       {boolean} [pauseOnAction=true]
 * @param       {boolean} [pauseOnHover=false]
 */

var Slider = function() { // ----- static module
                          // 
    // for more options, check out : https://www.woothemes.com/flexslider/
    var __options = {
        selector:           ".flexslider",
        namespace:          "flex-",
        animation:          "slide",
        easing:             "swing",
        animationLoop:      true,
        startAt:            0,
        initDelay:          0,
        slideshow:          false, // auto play on load                          
        slideshowSpeed:     4000,
        animationSpeed:     600,
        pauseOnHover:       true,
        controlNav:         true, //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
        directionNav:       true, //Boolean: Create navigation for previous/next navigation? (true/false)
        prevText:           "Previous",
        nextText:           "Next",
        randomize:          false,
        touch:              true,
        video:              false,
        pauseOnAction:      true,
        pauseOnHover:       false
    };

    /**
     * init
     *
     * @param      {object}  options  The options
     */
    var _init = function(options) {

        /* override static options with passed options */
        if( options )
            __options = options;

        var $slider = $(__options.selector);
        // console.log($slider)

        $slider.each(function(){
            console.log($(this))
            $(this).flexslider({
                namespace: __options.namespace,
                animation: __options.animation,
                slideshow: __options.slideshow,
                slideshowSpeed: __options.slideshowSpeed,
                animationSpeed: __options.animationSpeed,
                pauseOnHover: __options.pauseOnHover,
                controlNav: __options.controlNav,
                directionNav: __options.directionNav,
                prevText: __options.prevText,
                nextText: __options.nextText,
                randomize: __options.randomize,
                touch: __options.touch,
                video: __options.video
            });
        });

        
    };

    // getter(s)/setter(s) methods
    var _set = function(options) {
        for (var property_name in options) {
            if (options.hasOwnProperty(property_name)) {
                var property_value = options[property_name];
                if(__options.hasOwnProperty(property_name)) {
                    __options[property_name] = property_value;
                } else {
                    Util.log('Options.set() to a property that is not expected');
                    Util.log('property_name:',property_name,'property_value:',property_value);
                }
            }
        }
    };

    var _get = function() {
        return __options;
    };

    // output/public     
    return {
        init: _init,
        set: _set,
        get: _get,
    };
}(jQuery);