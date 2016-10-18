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