console.log( 'this happens only happens on the front page' );
(function() {

  console.log( 'first JS in the index.js' );

  $(function() {
    return window.app = 3;
  });

}).call(this);

(function($){
  console.log( 'I am in the slider' );
})(jQuery);