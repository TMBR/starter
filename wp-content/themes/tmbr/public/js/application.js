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
// TMBR Creative Agency
// Author: michael.ross
// Date: 6.27.2016
//
// Dependent Upon
// - jQuery
// - Modernizr
// Modules (static)
// - Constants

// ------------------ Constants (static)
var Constants = function($) {
    
    // output/public     
    return {
		//
		DIRECTION:{
			UP:'direction_up',
			DOWN:'direction_down',
			LEFT:'direction_left',
			RIGHT:'direction_right'
		},
		//
		CLASS_NAME:{
			//
			NEW:'new-item',
			SORT_ME:'sort-me',
		}
    };
}(jQuery);
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
// TMBR Creative Agency
// Dependent Upon
// - jQuery
//
var NavtoSelectList = function(element) { // ----- static module

    var _init = function() {
      $('ul.js-selectdropdown').each(function() {
        var select = $(document.createElement('select')).insertBefore($(this)).addClass('mobile-select').wrap( "<div class='select-nav-wrap'></div>" );
        $('>li a', this).each(function() {
            var a = $(this).click(function() {
                if ($(this).attr('target')==='_blank') {
                    window.open(this.href);
                }
                else {
                    window.location.href = this.href;
                }
            }),
            option = $(document.createElement('option')).appendTo(select).val(this.href).html($(this).html()).click(function() {
                a.click();
            });
        });
      });
    };
    // output/public
    return {
        init: _init
    };
}(jQuery);
// TMBR Creative Agency
// Date: 6.27.2016
// Dependent Upon
// - jQuery
// Module(s) (static)
// - Preloader
//
var Preloader = function($) { // ----- static module
    // private method(s)
    var _init = function() {
        $(window).load(function() {
            setTimeout(function() {
                $('.js-sitewrap').animate({
                    opacity: 1
                }, 300);
                $('#preloader').fadeOut(300, function() {
                    Animated.init();
                });
            }, 300); // delay 300 ms
        });
    };
    // output/public     
    return {
        init: _init
    };
}(jQuery);
// TMBR Creative Agency
// Author: galen.strasen
// Date: 8.24.2016
// Dependent Upon
// - jQuery
// - magnific popup
//
var Roadblock = function() { // ----- static module
    // private var
    var _init = function() {
        $(window).load(function() {
            var complete = jQuery.cookie('email-complete');
            var shown = jQuery.cookie('form-shown');
            var closed = jQuery.cookie('form-closed');
            var modalContent = $('#roadblock').length;

            function showCookieOverlay() {
                $.magnificPopup.open({
                    items: {
                        src: '#roadblock',
                        type: 'inline',
                    },
                    modal: true,
                    removalDelay: 300,
                    mainClass: 'tmbr-overlay -roadblock',
                    fixedContentPos: true,
                    alignTop: true,
                    closeOnBgClick: true,
                    preloader: false,
                    midClick: true,
                    closeBtnInside: false,
                    showCloseBtn: false
                });
                $('.js-alt-close').on('click', function(e) {
                    e.preventDefault();
                    $.magnificPopup.close();
                });
            }
            // IF USER HAS NOT COMPLETED NEWSLETTER FORM
            if (!complete) {
                // SET PAGE COUNT IF NET SET
                if (!shown) {
                    jQuery.cookie('form-shown', '1', {
                        path: '/'
                    });
                } else {
                    var value = parseFloat(shown);
                    value = value + 1;
                    jQuery.cookie('form-shown', value, {
                        path: '/'
                    });
                }
                // IF USER HAS VIEWED 3 PAGES & NOT CLOSED MODAL IN 7 DAYS
                if (shown === '3' && !closed) {
                    //if ( shown === '1' && !closed ) {
                    showCookieOverlay();
                }
                // LISTEN IF THEY CLOSE MODAL & SET THE COOKIE
                $(document).on('click', '.js-close', function(e) {
                    e.preventDefault();
                    $.magnificPopup.close();
                    jQuery.cookie('form-closed', 'true', {
                        expires: 7,
                        path: '/'
                    });
                });
            }
        }); //window.load
    };
    // output/public
    return {
        init: _init
    };
}(jQuery);
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
// TMBR Creative Agency
// Date: 6.27.2016

// Dependent Upon
// - jQuery
// Module(s) (static)
// - SmoothScroll

var SmoothScroll = function($) { // ----- static module

    // private method(s)
    var _init = function() {
    	$('a[href*=#]:not([href=#]).scroll-to').on('click','', function( e ) {
			e.preventDefault();

			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') || location.hostname == this.hostname) {
				var target = $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) +']');

				if (target.length) {
					$('html,body').animate(
						{ scrollTop: target.offset().top - 50 },
						{ duration: 600, easing:'easeOutCubic'}
					);
					return false;
				}

			}

		});
    };

    // output/public
    return {
        init: _init
    };
}(jQuery);
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

// TMBR Creative Agency
// Author: michael.ross
// Date: 6.27.2016
//
// Dependent Upon
// - jQuery
// Modules (static)
// - Util

// ------------------ Util (static)
var Util = function() {
	// private var(s)

	// getter(s)/setter(s) var(s)    
	var __debugMode = false;

	// todo : deine a local storage variable that can turn debugging on/off
	// getter(s)/setter(s) method(s)
	var _debugMode = function() {
		if (!arguments.length) return __debugMode;
		else __debugMode = arguments[0];
	};

	// private method(s)
	var _constructor = function() {
		// console.log('Util._constructor()');
	};

	// todo : add a force object for quick logs
	var _log = function() {
		if(!__debugMode) return;
		if (typeof console === "undefined" || typeof console.log === "undefined") return; // no log available

		for (var i = 0; i < arguments.length; i++) {
			var iteredArgument = arguments[i];
			// console.log(iteredArgument);
		}
	};

	/* Fancy Resize event that only triggers once the resize is DONE */
	var _on_resize = function(c,t){
		onresize = function(){
			clearTimeout(t);
			t=setTimeout(c,100)};
			return c
	};

	var _loadJSON = function(JSONLocation, onComplete) {
		// Util.log('_loadJSON() JSONLocation : ' + JSONLocation);
		$.ajax({
			url: JSONLocation,
			dataType: 'text',
			success: function(string) {
				data = $.parseJSON(string);
				if (onComplete && typeof(onComplete) === "function") onComplete(data);
			}
		});
	};

	var _loadBodyHTML = function(html_location, onComplete) {
		$.ajax({
			url: html_location,
			context: document.body,
			success: function(data) {
				if (onComplete && typeof(onComplete) === "function") onComplete(data);
			}
		});
	};


	var _split = function(string, delimiter) {
		if (typeof string !== 'string') return string;
		// string = string.replace(/\s/g, ''); // remove white space
		string = string.replace(/^\s+|\s+$/g, ""); // remove white space up to first charactor and after last charactor
		// when we drop support for ie 8
		// string = string.trim(); // remove white space up to first charactor and after last charactor
		return string.split(delimiter); // create array
	};

	var _uid = function() {
		return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
			var r = Math.random() * 16 | 0,
				v = c == 'x' ? r : (r & 0x3 | 0x8);
			return v.toString(16);
		});
	};

	// array specific
	var _removeBlankStrings = function(array) {
		var newArray = [];
		for (var i = 0; i < array.length; i++) {
			var iteredItem = array[i];
			if (iteredItem !== '') newArray.push(iteredItem);
		}
		return newArray;
	};

	var _shuffleArray = function(o) {
		for (var j, x, i = o.length; i; j = Math.floor(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
		return o;
	};

	var _removeArrayDuplicates = function(array) {
		var a = array.concat();
		for (var i = 0; i < a.length; ++i) {
			for (var j = i + 1; j < a.length; ++j) {
				if (a[i] === a[j]) a.splice(j--, 1);
			}
		}
		return a;
	};

	var _mergeArrays = function() {
		var i, ii, newArray = [],
			arrayAmount, iteredArray, iteredArrayContentsAmount;
		arrayAmount = arguments.length;
		for (i = 0; i < arrayAmount; i++) {
			iteredArray = arguments[i];
			iteredArrayContentsAmount = iteredArray.length;
			for (ii = 0; ii < iteredArrayContentsAmount; ii++) {
				newArray.push(iteredArray[ii]);
			}
		}
		return newArray;
	};

	var _randomItemFromArray = function(array) {
		return array[Math.floor(Math.random()*array.length)];
	};

	// from : https://remysharp.com
	var _debounce = function(fn, delay) {
		var timer = null;
		return function() {
			var context = this,
				args = arguments;
			clearTimeout(timer);
			timer = setTimeout(function() {
				fn.apply(context, args);
			}, delay);
		};
	};

	// from : https://remysharp.com
	var _throttle = function(fn, threshhold, scope) {
		threshhold || (threshhold = 250);
		var last,
			deferTimer;
		return function() {
			var context = scope || this;

			var now = +new Date,
				args = arguments;
			if (last && now < last + threshhold) {
				// hold on to it
				clearTimeout(deferTimer);
				deferTimer = setTimeout(function() {
					last = now;
					fn.apply(context, args);
				}, threshhold);
			} else {
				last = now;
				fn.apply(context, args);
			}
		};
	};

	var _booleanHelper = function(string) {
		if (typeof string === 'boolean') return string;
		if (typeof string === 'undefined') return false;
		switch (string.toLowerCase()) {
			case "true":
			case "yes":
			case "1":
				return true;
			case "false":
			case "no":
			case "0":
			case null:
				return false;
			default:
				return Boolean(string);
		}
	};

	var _getQueryParameters = function(_s) {
		var query = _s;
		var parameters = query.split("&");
		var result = {};
		if (!parameters.length) return false;
		for (var i = 0; i < parameters.length; i++) {
			var iteredParam = parameters[i];
			var item = iteredParam.split("=");
			result[item[0]] = decodeURIComponent(item[1]);
		}
		return result;
	};

	var _deepCompare = function() {
		var i, l, leftChain, rightChain;

		var _compare2Objects = function(x, y) {
			var p;
			// remember that NaN === NaN returns false
			// and isNaN(undefined) returns true
			if (isNaN(x) && isNaN(y) && typeof x === 'number' && typeof y === 'number') return true;
			// Compare primitives and functions.     
			// Check if both arguments link to the same object.
			// Especially useful on step when comparing prototypes
			if (x === y) return true;
			// Works in case when functions are created in constructor.
			// Comparing dates is a common scenario. Another built-ins?
			// We can even handle functions passed across iframes
			if ((typeof x === 'function' && typeof y === 'function') ||
				(x instanceof Date && y instanceof Date) ||
				(x instanceof RegExp && y instanceof RegExp) ||
				(x instanceof String && y instanceof String) ||
				(x instanceof Number && y instanceof Number)) {
				return x.toString() === y.toString();
			}
			// At last checking prototypes as good a we can
			if (!(x instanceof Object && y instanceof Object)) return false;
			if (x.isPrototypeOf(y) || y.isPrototypeOf(x)) return false;
			if (x.constructor !== y.constructor) return false;
			if (x.prototype !== y.prototype) return false;
			// Check for infinitive linking loops
			if (leftChain.indexOf(x) > -1 || rightChain.indexOf(y) > -1) return false;
			// Quick checking of one object beeing a subset of another.
			// todo: cache the structure of arguments[0] for performance
			for (p in y) {
				if (y.hasOwnProperty(p) !== x.hasOwnProperty(p)) return false;
				else if (typeof y[p] !== typeof x[p]) return false;
			}

			for (p in x) {
				if (y.hasOwnProperty(p) !== x.hasOwnProperty(p)) return false;
				else if (typeof y[p] !== typeof x[p]) return false;
				switch (typeof(x[p])) {
					case 'object':
					case 'function':
						leftChain.push(x);
						rightChain.push(y);
						if (!_compare2Objects(x[p], y[p])) return false;
						leftChain.pop();
						rightChain.pop();
						break;
					default:
						if (x[p] !== y[p]) return false;
						break;
				}
			}
			return true;
		};

		if (arguments.length < 1) {
			return true; //Die silently? Don't know how to handle such case, please help...
			// throw "Need two or more arguments to compare";
		}
		for (i = 1, l = arguments.length; i < l; i++) {
			leftChain = []; // todo: this can be cached
			rightChain = [];
			if (!_compare2Objects(arguments[0], arguments[i])) {
				return false;
			}
		}
		return true;
	};

	


	_constructor();
	// output/public     
	return {
		debugMode: _debugMode,
		log: _log,
		onresize: _on_resize,
		loadJSON: _loadJSON,
		loadBodyHTML: _loadBodyHTML,
		// string
		String: {
			split: _split,
			uid: _uid
		},
		// array todo:organize and name accordingly on the private level
		Array: {
			removeBlankStrings: _removeBlankStrings,
			shuffle: _shuffleArray,
			removeDuplicates: _removeArrayDuplicates,
			merge: _mergeArrays,
			randomItemFromArray:_randomItemFromArray
		},
		//
		debounce: _debounce,
		throttle: _throttle,
		booleanHelper: _booleanHelper,
		getQueryParameters: _getQueryParameters,
		deepCompare:_deepCompare
	};
}();

// 
if (!Array.prototype.indexOf) {
	Array.prototype.indexOf = function(elt /*, from*/ ) {
		var len = this.length >>> 0;

		var from = Number(arguments[1]) || 0;
		from = (from < 0) ? Math.ceil(from) : Math.floor(from);
		if (from < 0)
			from += len;

		for (; from < len; from++) {
			if (from in this &&
				this[from] === elt)
				return from;
		}
		return -1;
	};
}
// Credit goes to [Underscore.js](http://underscorejs.org/)

/**
 * Returns a function, that, when invoked, will only be triggered at most
 * once during a given window of time. Normally, the throttled function will
 * run as much as it can, without ever going more than once per wait
 * duration; but if you’d like to disable the execution on the leading edge,
 * pass {leading: false}. To disable execution on the trailing edge, ditto.
 */

// throttle's dependent upon _now
_now = Date.now || function() {
  return new Date().getTime();
};

_throttle = function(func, wait, options) {
  var context, args, result;
  var timeout = null;
  var previous = 0;
  if (!options) options = {};
  var later = function() {
    previous = options.leading === false ? 0 : _now();
    timeout = null;
    result = func.apply(context, args);
    if (!timeout) context = args = null;
  };
  return function() {
    var now = _now();
    if (!previous && options.leading === false) previous = now;
    var remaining = wait - (now - previous);
    context = this;
    args = arguments;
    if (remaining <= 0 || remaining > wait) {
      if (timeout) {
        clearTimeout(timeout);
        timeout = null;
      }
      previous = now;
      result = func.apply(context, args);
      if (!timeout) context = args = null;
    } else if (!timeout && options.trailing !== false) {
      timeout = setTimeout(later, remaining);
    }
    return result;
  };
};

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