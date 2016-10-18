// TMBR Creative Agency
// Date: 6.27.2016

// Dependent Upon
// - jQuery
// - Util
// - Constants
// Module(s) (static)
// - Control
//
//

var MobileDetect = function($) { // ----- static module
    // private var(s)
    var ismobile = (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent));

    // private method(s)
    var _detect = function() {
       if(ismobile == true){
            $('body').addClass('mobile');
        } else {
            $('body').addClass('no-touch');
        }

    };

    // output/public     
    return {
        detect: _detect
    };
}(jQuery);