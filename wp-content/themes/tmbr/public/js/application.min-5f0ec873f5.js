var Slider=function(n){var e={init:function(){n(document).ready(function(){n("#home_slider").flexslider({animation:"slide",slideshow:!1,slideshowSpeed:4e3,animationSpeed:600,pauseOnHover:!0,controlNav:!0,directionNav:!0,prevText:"Previous",nextText:"Next"})})}};return e}(jQuery);_now=Date.now||function(){return(new Date).getTime()},_throttle=function(n,e,i){var o,t,r,l=null,a=0;i||(i={});var u=function(){a=i.leading===!1?0:_now(),l=null,r=n.apply(o,t),l||(o=t=null)};return function(){var d=_now();a||i.leading!==!1||(a=d);var s=e-(d-a);return o=this,t=arguments,0>=s||s>e?(l&&(clearTimeout(l),l=null),a=d,r=n.apply(o,t),l||(o=t=null)):l||i.trailing===!1||(l=setTimeout(u,s)),r}};var ismobile=/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);!function(n){Slider.init(),1==ismobile&&n("body").addClass("mobile"),n(function(){}),n(window).on("load",function(){});var e=50;n(window).on("scroll",_throttle(function(){},e)),n(window).on("resize",_throttle(function(){},e))}(jQuery);