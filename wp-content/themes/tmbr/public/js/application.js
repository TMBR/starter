// TMBR Creative Agency
// Date: 6.27.2016

/**
 * @name Animated
 * @private
 * @param {object} jQuery
 * @returns {object} Animated.init
 * * @returns {object} Animated.ShowAnimated
*/
var Animated = function($) { // ----- static module
    // private var(s)


    // private method(s)
    var _init = function() {

        // TODO: Make this fuction work with passed in selector

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

       console.log("animated init");
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


/**
 * @name Constants
 * @static
 * @param {object} jQuery
 * @returns {object} DIRECTION : UP,DOWN,LEFT,RIGHT
*/
var Constants = function($) {
    
    // output/public     
    return {
		//
		DIRECTION:{
			UP:'direction_up',
			DOWN:'direction_down',
			LEFT:'direction_left',
			RIGHT:'direction_right'
		}
    };
}(jQuery);
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

/**
 * Adds a preloader across the site
 * @class      Preloader (name)
 * @return     {Constructor} Preloader.init()
 */

var Preloader = function($) { // ----- static module

    var _init = function() {

        $(window).on("load", function(){
            setTimeout(function() {
                $('.js-sitewrap').animate({
                    opacity: 1
                }, 300);
                $('#preloader').fadeOut(300, function() {
                    Animated.init();
                });
            }, 300);
        });
    };

    return {
        init: _init
    };
}(jQuery);
// TMBR Creative Agency
// Author: galen.strasen
// Date: 8.24.2016

/**
 * Enables TMBR Roadblock modal
 * @class      Roadblock (name)
 * @return     {Constructor} Roadblock.init()
 */
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
// TMBR Creative Agency
// Date: 6.27.2016

/**
 * Set up smooth scroll on anchor click
 *
 * @class      	SmoothScroll (name)
 * @return  	{constructor} init
 */
var SmoothScroll = function($) { // ----- static module

    var _init = function() {
    	$('a[href*=#]:not([href=#]).scroll-to').on('click','', function( e ) {
			e.preventDefault();

			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') || location.hostname == this.hostname) {
				var target = $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) +']');

				if (target.length) {
					$('html,body').animate(
						{ scrollTop: target.offset().top },
						{ duration: 600, easing:'easeOutCubic'}
					);
					return false;
				}

			}

		});
    };

    return {
        init: _init
    };
}(jQuery);
// TMBR Creative Agency
// Author: Sarah Cleveland
// Date: 9.25.2016

/**
 * Creates Tabs on selected items
 *
 * @class      Tabs (name)
 * @return     {Constructor} init(options)
 * @param      {string} [$tabContainer] - jQuery selector container
 */

var Tabs = function($) {

    var $tabContainer,
        $tabs,
        $tabsContent,
        $firstTabs,
        windowSize,
        mobileWidth,
        isMobile;

    var _init = function(options) {
        $tabContainer = options.container;
        $tabs = $tabContainer.find('[data-tab]');
        $tabsContent = $tabContainer.find('[data-tab-content]');
        $firstTabs = $tabContainer.find('[data-tab-content="1"]');

        windowSize = $(window).outerWidth();
        mobileWidth = 768;
        isMobile = windowSize <= mobileWidth;

        if(isMobile){
            _toggleTabs($firstTabs);
        }

        $(window).on('resize', function(){
            windowSize = $(window).outerWidth();

            if(windowSize > mobileWidth && isMobile === true){
                isMobile = false;
                _toggleTabs($tabsContent);
            } else if(windowSize <= mobileWidth && isMobile === false){
                isMobile = true;
                _toggleTabs($firstTabs);
            }
        });

        $('#checkingtype').on('change', function(){
            if(options.mobileOnly === true && windowSize <= mobileWidth){
                var tab = $(event.target).find(':selected');
                _openTabContent(tab);
            }
        });
    };

    var _openTabContent = function(tab){
        var int = tab.data('tab');
        var selectedTabs = $tabContainer.find('[data-tab-content="'+int+'"]');

        _toggleTabs(selectedTabs);
    }

    var _toggleTabs = function(selectedTabs){
        $tabsContent.addClass('hidden');
        selectedTabs.removeClass('hidden');
    }

    // output/public
    return {
        init: _init
    };
}(jQuery);
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

// TMBR Creative Agency
// Author: michael.ross
// Date: 6.27.2016

/**
 * Utility functions commonly used in Javascript
  * @class      Util (name)
 */
var Util = function() {

	/**
	 * Enables debug mode
	 *
	 * @type       {boolean} Enables debug mode
	 */
	var __debugMode = false;

	// todo : deine a local storage variable that can turn debugging on/off
	// getter(s)/setter(s) method(s)
	var _debugMode = function() {
		if (!arguments.length) return __debugMode;
		else __debugMode = arguments[0];
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

	/**
	 * Loads a json.
	 *
	 * @param      {string}    JSONLocation  The json location
	 * @param      {Function}  onComplete    On complete
	 */
	var _loadJSON = function(JSONLocation, onComplete) {
		$.ajax({
			url: JSONLocation,
			dataType: 'text',
			success: function(string) {
				data = $.parseJSON(string);
				if (onComplete && typeof(onComplete) === "function") onComplete(data);
			}
		});
	};

	/**
	 * Loads a body html.
	 *
	 * @param      {string}    html_location  The html location
	 * @param      {Function}  onComplete     On complete
	 */
	var _loadBodyHTML = function(html_location, onComplete) {
		$.ajax({
			url: html_location,
			context: document.body,
			success: function(data) {
				if (onComplete && typeof(onComplete) === "function") onComplete(data);
			}
		});
	};

	/**
	 * { function_description }
	 *
	 * @param      {string}  string     The string
	 * @param      {string}  delimiter  The delimiter
	 * @return     {string}  { Returns the string split on the delimiter }
	 */
	var _split = function(string, delimiter) {
		if (typeof string !== 'string') return string;
		// string = string.replace(/\s/g, ''); // remove white space
		string = string.replace(/^\s+|\s+$/g, ""); // remove white space up to first charactor and after last charactor
		// when we drop support for ie 8
		// string = string.trim(); // remove white space up to first charactor and after last charactor
		return string.split(delimiter); // create array
	};

	/**
	 * Returns a random string value
	 *
	 * @return     {string}  Returns a random string value
	 */
	var _uid = function() {
		return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
			var r = Math.random() * 16 | 0,
				v = c == 'x' ? r : (r & 0x3 | 0x8);
			return v.toString(16);
		});
	};

	/**
	 * Removes blank strings.
	 *
	 * @param      {Array}
	 * @return     {Array} Removes blank values in an array
	 */
	var _removeBlankStrings = function(array) {
		var newArray = [];
		for (var i = 0; i < array.length; i++) {
			var iteredItem = array[i];
			if (iteredItem !== '') newArray.push(iteredItem);
		}
		return newArray;
	};

	/**
	 * Suffles an Array
	 *
	 * @param      {Array}
	 * @return     {Array} Shuffled array.
	 */
	var _shuffleArray = function(o) {
		for (var j, x, i = o.length; i; j = Math.floor(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
		return o;
	};

	/**
	 * Removes array duplicates.
	 *
	 * @param      {Array}
	 * @return     {Array}
	 */
	var _removeArrayDuplicates = function(array) {
		var a = array.concat();
		for (var i = 0; i < a.length; ++i) {
			for (var j = i + 1; j < a.length; ++j) {
				if (a[i] === a[j]) a.splice(j--, 1);
			}
		}
		return a;
	};

	/**
	 * Merges two arrays
	 *
	 * @param      {Array}
	 * @param      {Array}
	 * @return     {Array}
	 */
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

	/**
	 * Returns a random item from array
	 *
	 * @param      {Array}
	 * @return     {Array}
	 */
	var _randomItemFromArray = function(array) {
		return array[Math.floor(Math.random()*array.length)];
	};

	/**
	 * Debounce
	 *
	 * @param      {Function}  Function to delay
	 * @param      {Number} Miliseconds to delay the function
	 * @return     {Function} 
	 */
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

	/**
	 * Throttle
	 *
	 * @param      {Function}
	 * @param      {number}    threshhold  The threshhold
	 * @param      {String}    scope       The scope
	 * @return     {Function}
	 */
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

	/**
	 * Gets the URL query parameters.
	 *
	 * @param      {String}
	 * @return     {Object}  The query parameters in key / pair.
	 */
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

	
	// output/public     
	return {
		debugMode: _debugMode,
		log: _log,
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

function ssc_init() {
    if (!document.body) return;
    var e = document.body;
    var t = document.documentElement;
    var n = window.innerHeight;
    var r = e.scrollHeight;

    ssc_root = document.compatMode.indexOf("CSS") >= 0 ? t : e;
    ssc_activeElement = e;
    ssc_initdone = true;

    if (top != self)
        ssc_frame = true;

    else if (r > n && (e.offsetHeight <= n || t.offsetHeight <= n)) {
        ssc_root.style.height = "auto";
        if (ssc_root.offsetHeight <= n) {
            var i = document.createElement("div");
            i.style.clear = "both";
            e.appendChild(i)
        }
    }

    if (!ssc_fixedback) {
        e.style.backgroundAttachment = "scroll";
        t.style.backgroundAttachment = "scroll"
    }

    if (ssc_keyboardsupport)
        ssc_addEvent("keydown", ssc_keydown);
}

function ssc_scrollArray(e, t, n, r) {
    r || (r = 1e3);
    ssc_directionCheck(t, n);
    ssc_que.push({
        x: t,
        y: n,
        lastX: t < 0 ? .99 : -.99,
        lastY: n < 0 ? .99 : -.99,
        start: +(new Date)
    });

    if (ssc_pending)
        return;

    var i = function () {
        var s = +(new Date);
        var o = 0;
        var u = 0;
        for (var a = 0; a < ssc_que.length; a++) {
            var f = ssc_que[a];
            var l = s - f.start;
            var c = l >= ssc_animtime;
            var h = c ? 1 : l / ssc_animtime;
            if (ssc_pulseAlgorithm) {
                h = ssc_pulse(h)
            }
            var p = f.x * h - f.lastX >> 0;
            var d = f.y * h - f.lastY >> 0;
            o += p;
            u += d;
            f.lastX += p;
            f.lastY += d;
            if (c) {
                ssc_que.splice(a, 1);
                a--
            }
        }
        if (t) {
            var v = e.scrollLeft;
            e.scrollLeft += o;
            if (o && e.scrollLeft === v) {
                t = 0
            }
        }
        if (n) {
            var m = e.scrollTop;
            e.scrollTop += u;
            if (u && e.scrollTop === m) {
                n = 0
            }
        }
        if (!t && !n)
            ssc_que = [];

        if (ssc_que.length)
            setTimeout(i, r / ssc_framerate + 1);
        else
            ssc_pending = false;
    };
    setTimeout(i, 0);
    ssc_pending = true
}

function ssc_wheel(e) {
    if (!ssc_initdone) {
        ssc_init()
    }
    var t = e.target;
    var n = ssc_overflowingAncestor(t);
    if (!n || e.defaultPrevented || ssc_isNodeName(ssc_activeElement, "embed") || ssc_isNodeName(t, "embed") && /\.pdf/i.test(t.src)) {
        return true
    }
    var r = e.wheelDeltaX || 0;
    var i = e.wheelDeltaY || 0;
    if (!r && !i)
        i = e.wheelDelta || 0;

    if (Math.abs(r) > 1.2)
        r *= ssc_stepsize / 120;

    if (Math.abs(i) > 1.2)
        i *= ssc_stepsize / 120;

    ssc_scrollArray(n, -r, -i);
    e.preventDefault()
}

function ssc_keydown(e) {
    var t = e.target;
    var n = e.ctrlKey || e.altKey || e.metaKey;

    if (/input|textarea|embed/i.test(t.nodeName) || t.isContentEditable || e.defaultPrevented || n)
        return true;

    if (ssc_isNodeName(t, "button") && e.keyCode === ssc_key.spacebar)
        return true;

    var r, i = 0,
        s = 0;
    var o = ssc_overflowingAncestor(ssc_activeElement);
    var u = o.clientHeight;

    if (o == document.body)
        u = window.innerHeight;

    switch (e.keyCode) {
        case ssc_key.up:
            s = -ssc_arrowscroll;
            break;
        case ssc_key.down:
            s = ssc_arrowscroll;
            break;
        case ssc_key.spacebar:
            r = e.shiftKey ? 1 : -1;
            s = -r * u * .9;
            break;
        case ssc_key.pageup:
            s = -u * .9;
            break;
        case ssc_key.pagedown:
            s = u * .9;
            break;
        case ssc_key.home:
            s = -o.scrollTop;
            break;
        case ssc_key.end:
            var a = o.scrollHeight - o.scrollTop - u;
            s = a > 0 ? a + 10 : 0;
            break;
        case ssc_key.left:
            i = -ssc_arrowscroll;
            break;
        case ssc_key.right:
            i = ssc_arrowscroll;
            break;
        default:
            return true
    }
    ssc_scrollArray(o, i, s);
    e.preventDefault()
}

function ssc_mousedown(e) {
    ssc_activeElement = e.target
}

function ssc_setCache(e, t) {
    for (var n = e.length; n--;) ssc_cache[ssc_uniqueID(e[n])] = t;
    return t
}

function ssc_overflowingAncestor(e) {
    var t = [];
    var n = ssc_root.scrollHeight;
    do {
        var r = ssc_cache[ssc_uniqueID(e)];
        if (r) {
            return ssc_setCache(t, r)
        }
        t.push(e);
        if (n === e.scrollHeight) {
            if (!ssc_frame || ssc_root.clientHeight + 10 < n) {
                return ssc_setCache(t, document.body)
            }
        } else if (e.clientHeight + 10 < e.scrollHeight) {
            overflow = getComputedStyle(e, "").getPropertyValue("overflow");
            if (overflow === "scroll" || overflow === "auto") {
                return ssc_setCache(t, e)
            }
        }
    }
    while (e = e.parentNode)
}

function ssc_addEvent(e, t, n) {
    window.addEventListener(e, t, n || false)
}

function ssc_removeEvent(e, t, n) {
    window.removeEventListener(e, t, n || false)
}

function ssc_isNodeName(e, t) {
    return e.nodeName.toLowerCase() === t.toLowerCase()
}

function ssc_directionCheck(e, t) {
    e = e > 0 ? 1 : -1;
    t = t > 0 ? 1 : -1;
    if (ssc_direction.x !== e || ssc_direction.y !== t) {
        ssc_direction.x = e;
        ssc_direction.y = t;
        ssc_que = []
    }
}

function ssc_pulse_(e) {
    var t, n, r;
    e = e * ssc_pulseScale;
    if (e < 1) {
        t = e - (1 - Math.exp(-e))
    } else {
        n = Math.exp(-1);
        e -= 1;
        r = 1 - Math.exp(-e);
        t = n + r * (1 - n)
    }
    return t * ssc_pulseNormalize
}

function ssc_pulse(e) {
    if (e >= 1) return 1;
    if (e <= 0) return 0;
    if (ssc_pulseNormalize == 1) {
        ssc_pulseNormalize /= ssc_pulse_(1)
    }
    return ssc_pulse_(e)
}

var ssc_framerate = 150;
var ssc_animtime = 500;
var ssc_stepsize = 150;
var ssc_pulseAlgorithm = true;
var ssc_pulseScale = 6;
var ssc_pulseNormalize = 1;
var ssc_keyboardsupport = true;
var ssc_arrowscroll = 50;
var ssc_frame = false;
var ssc_direction = {
    x: 0,
    y: 0
};
var ssc_initdone = false;
var ssc_fixedback = true;
var ssc_root = document.documentElement;
var ssc_activeElement;
var ssc_key = {
    left: 37,
    up: 38,
    right: 39,
    down: 40,
    spacebar: 32,
    pageup: 33,
    pagedown: 34,
    end: 35,
    home: 36
};
var ssc_que = [];
var ssc_pending = false;
var ssc_cache = {};

setInterval(function () {
    ssc_cache = {}
}, 10 * 1e3);

var ssc_uniqueID = function () {
    var e = 0;
    return function (t) {
        return t.ssc_uniqueID || (t.ssc_uniqueID = e++)
    }
}();

var ischrome = /chrome/.test(navigator.userAgent.toLowerCase());
if (ischrome) {
    ssc_addEvent("mousedown", ssc_mousedown);
    ssc_addEvent("mousewheel", ssc_wheel);
    ssc_addEvent("load", ssc_init)
}

// TMBR Creative Agency
// Author: michael.ross
// Date: 6.27.2016
// updated: 10.4.2016
//
// Doc - https://github.com/documentationjs/documentation/blob/master/docs/GETTING_STARTED.md

/**
 * This function is called at Document.ready()
 * @name Control
 * @private
 * @param {object} jQuery
 * @returns {object} Control + methods
 * @example Control.init();
*/
var Control = function($) { // ----- static module
    // private var(s)
    var sliderOptions = {
        selector:           ".flexslider",
        namespace:          "flex-",
        animation:          "slide",
        slideshow:          false, // auto play on load
        slideshowSpeed:     2000,
        animationSpeed:     500,
        pauseOnHover:       true,
        controlNav:         false, //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
        directionNav:       true, //Boolean: Create navigation for previous/next navigation? (true/false)
        prevText:           "Previous",
        nextText:           "Next",
        randomize:          false,
        touch:              true,
        video:              true
    }

    // private method(s)
    var _init = function() {

        Preloader.init();
        //Throttle.init();
        SmoothScroll.init();
        Animated.init();
        Slider.init(sliderOptions);
        SlickSlider.init();
        Lightbox.init();
    };

    // output/public
    return {
        init: _init
    };
}(jQuery);

/**
 * This function fires off Control.init();
*/
jQuery(document).ready(function() {
    Control.init();
});