<?php

// Creates multiple Options Pages with ACF Options Page Add-On
// http://www.advancedcustomfields.com/resources/filters/acfoptions_pagesettings/

function my_acf_options_page_settings( $settings ) {
	 $settings['title'] = 'Options';
	 $settings['pages'] = array('Option Page #1', 'Option Page #2');

	 return $settings;
}

add_filter('acf/options_page/settings', 'my_acf_options_page_settings');


?>