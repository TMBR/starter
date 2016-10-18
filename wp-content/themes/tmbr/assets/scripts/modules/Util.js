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
