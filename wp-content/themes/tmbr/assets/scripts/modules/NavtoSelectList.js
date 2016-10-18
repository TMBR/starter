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