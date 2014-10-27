/* ON DOM READY
====================================*/
jQuery(document).ready(function($) {

    function toggleNav() {
        if ($('#site-wrapper').hasClass('show-nav')) {
            // Do things on Nav Close
            $('#site-wrapper').removeClass('show-nav');
        } else {
            // Do things on Nav Open
            $('#site-wrapper').addClass('show-nav');
            $("html, body").animate({ scrollTop: 0 }, "slow");
        }
    }

    // Toggle Nav on Click
    $('.toggle-nav').click(function() {
        toggleNav();
    });

    // OWL slider
    $("#home-slide").owlCarousel({
        autoPlay : 3000,
        stopOnHover : true,
        navigation:false,
        pagination:false,
        paginationSpeed : 1000,
        goToFirstSpeed : 2000,
        singleItem : true,
        transitionStyle:"fade"
    });

});