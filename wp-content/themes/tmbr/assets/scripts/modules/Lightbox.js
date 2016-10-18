// TMBR Creative Agency
// Author: galen.strasen
// Date: 7.19.2016
// Dependent Upon
// - jQuery
// - magnific popup
// Module(s) (static)
// - Lightbox
//

var Lightbox = function(element) { // ----- static module
    // private var(s)


    // private method(s)
    var _init = function() {

        $('.js-popup-img').magnificPopup({
            type:'image',
            mainClass: 'tmbr-overlay -media -img'

        });

        $('.js-popup-video').magnificPopup({
            type: 'iframe',
            removalDelay: 300,
            mainClass: 'tmbr-overlay -media -video',
            fixedContentPos: true,
            closeOnBgClick: true,
            preloader: false,
            closeBtnInside: true

        });

        $('.js-iframe-trigger').magnificPopup({
          type: 'iframe',
          removalDelay: 300,
          mainClass: 'tmbr-overlay -content -iframe',
          fixedContentPos: true,
          alignTop: true,
          closeOnBgClick: true,
          preloader: true,
          midClick: true,
          closeBtnInside: true
        });

        $('.js-o-trigger').magnificPopup({
          type: 'inline',
          removalDelay: 300,
          mainClass: 'tmbr-overlay -content',
          fixedContentPos: true,
          alignTop: true,
          closeOnBgClick: true,
          preloader: false,
          midClick: true,
          closeBtnInside: true

        });

        // Flex Content image gallery with modal
        $('.js-img-gallery').magnificPopup({
          type: 'image',
          mainClass: 'tmbr-overlay -media -img -gallery',
          delegate: 'a',
          fixedContentPos: true,
          closeOnBgClick: true,
          gallery: {
            enabled: true,
            tCounter: '', // markup of counter
            arrowMarkup: '' // markup of an arrow button
          }

        });


        Util.log("Lightbox.init");
    };

    // output/public
    return {
        init: _init
    };
}(jQuery);
