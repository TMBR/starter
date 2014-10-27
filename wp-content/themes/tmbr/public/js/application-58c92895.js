(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);throw new Error("Cannot find module '"+o+"'")}var f=n[o]={exports:{}};t[o][0].call(f.exports,function(e){var n=t[o][1][e];return s(n?n:e)},f,f.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
var Application;

module.exports = Application = (function() {
  function Application() {
    console.log('invoked dude!');
  }

  return Application;

})();


},{}],2:[function(require,module,exports){
var app;

app = require('./app/app');

$(function() {
  return window.app = new app();
});


},{"./app/app":1}]},{},[2])
//# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIi9Vc2Vycy9tYXR0L3dlYi9zdGFydGVyLmRldi9odG1sL3N0YXJ0ZXItdGhlbWUvd3AtY29udGVudC90aGVtZXMvdG1ici9ub2RlX21vZHVsZXMvZ3VscC1icm93c2VyaWZ5L25vZGVfbW9kdWxlcy9icm93c2VyaWZ5L25vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCIvVXNlcnMvbWF0dC93ZWIvc3RhcnRlci5kZXYvaHRtbC9zdGFydGVyLXRoZW1lL3dwLWNvbnRlbnQvdGhlbWVzL3RtYnIvYXNzZXRzL3NjcmlwdHMvYXBwL2FwcC5jb2ZmZWUiLCIvVXNlcnMvbWF0dC93ZWIvc3RhcnRlci5kZXYvaHRtbC9zdGFydGVyLXRoZW1lL3dwLWNvbnRlbnQvdGhlbWVzL3RtYnIvYXNzZXRzL3NjcmlwdHMvaW5kZXguY29mZmVlIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBO0FDQUEsSUFBQSxXQUFBOztBQUFBLE1BQU0sQ0FBQyxPQUFQLEdBQ1E7QUFDUyxFQUFBLHFCQUFBLEdBQUE7QUFDWCxJQUFBLE9BQU8sQ0FBQyxHQUFSLENBQVksZUFBWixDQUFBLENBRFc7RUFBQSxDQUFiOztxQkFBQTs7SUFGSixDQUFBOzs7O0FDQUEsSUFBQSxHQUFBOztBQUFBLEdBQUEsR0FBTSxPQUFBLENBQVEsV0FBUixDQUFOLENBQUE7O0FBQUEsQ0FFQSxDQUFFLFNBQUEsR0FBQTtTQUNBLE1BQU0sQ0FBQyxHQUFQLEdBQWlCLElBQUEsR0FBQSxDQUFBLEVBRGpCO0FBQUEsQ0FBRixDQUZBLENBQUEiLCJmaWxlIjoiZ2VuZXJhdGVkLmpzIiwic291cmNlUm9vdCI6IiIsInNvdXJjZXNDb250ZW50IjpbIihmdW5jdGlvbiBlKHQsbixyKXtmdW5jdGlvbiBzKG8sdSl7aWYoIW5bb10pe2lmKCF0W29dKXt2YXIgYT10eXBlb2YgcmVxdWlyZT09XCJmdW5jdGlvblwiJiZyZXF1aXJlO2lmKCF1JiZhKXJldHVybiBhKG8sITApO2lmKGkpcmV0dXJuIGkobywhMCk7dGhyb3cgbmV3IEVycm9yKFwiQ2Fubm90IGZpbmQgbW9kdWxlICdcIitvK1wiJ1wiKX12YXIgZj1uW29dPXtleHBvcnRzOnt9fTt0W29dWzBdLmNhbGwoZi5leHBvcnRzLGZ1bmN0aW9uKGUpe3ZhciBuPXRbb11bMV1bZV07cmV0dXJuIHMobj9uOmUpfSxmLGYuZXhwb3J0cyxlLHQsbixyKX1yZXR1cm4gbltvXS5leHBvcnRzfXZhciBpPXR5cGVvZiByZXF1aXJlPT1cImZ1bmN0aW9uXCImJnJlcXVpcmU7Zm9yKHZhciBvPTA7bzxyLmxlbmd0aDtvKyspcyhyW29dKTtyZXR1cm4gc30pIiwibW9kdWxlLmV4cG9ydHMgPVxuICBjbGFzcyBBcHBsaWNhdGlvblxuICAgIGNvbnN0cnVjdG9yOiAtPlxuICAgICAgY29uc29sZS5sb2cgJ2ludm9rZWQgZHVkZSEnIiwiYXBwID0gcmVxdWlyZSgnLi9hcHAvYXBwJylcblxuJCAtPlxuICB3aW5kb3cuYXBwID0gbmV3IGFwcCgpIl19
