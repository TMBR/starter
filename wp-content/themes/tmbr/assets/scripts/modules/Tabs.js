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