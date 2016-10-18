// TMBR Creative Agency
// Date: 6.27.2016

/**
 * Provides Lightbox Capabilities
 * @class      Lightbox (name)
 * @param      {element} <element> Pass in jQuery element for event target
 * @return     {Constructor}  Lightbox.init()
 */
var Lightbox = function(element) { // ----- static module

    var _init = function() {
        $('.imagepop').magnificPopup({type:'image'});

        // Flex Content image gallery with modal
        $('.js-flex-gallery-img').magnificPopup({
            type: 'image',
            gallery:{
                enabled:true
            }
        });
    };

    // output/public     
    return {
        init: _init
    };
}(jQuery);
