// TMBR Creative Agency
// Date: 6.27.2016
// Dependent Upon
// - jQuery
// Module(s) (static)
// - Animated
//
//
var Animated = function($) { // ----- static module
    // private var(s)
    // private method(s)
    var _init = function() {
        // TODO: Make this fuction work with passed in selector
        function animateRun() {
            $('.animation, .animation-visible').each(function() {
                var $element = $(this);
                $element.waypoint(function() {
                    var delay = 0;
                    if ($element.attr('data-delay')) delay = parseInt($element.attr('data-delay'), 0);
                    if (!$element.hasClass('animated')) {
                        setTimeout(function() {
                            $element.addClass('animated ' + $element.attr('data-animation'));
                        }, delay);
                    }
                    delay = 0;
                }, {
                    offset: '80%'
                });
            });
        }
        var ismobile = (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent));
        if (ismobile != true) {
            animateRun();
            //animate();
        }
    };
    // Show All Animated Items
    var _showAnimated = function() {
        $('.animation, .animation-visible').each(function() {
            $(this).addClass('animated');
        });
    };
    // output/public
    return {
        init: _init,
        ShowAnimated: _showAnimated
    };
}(jQuery);