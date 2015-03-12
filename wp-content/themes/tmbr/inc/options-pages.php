<?php

// ACF PRO Options pages
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

	/*
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	));
	*/
}


// Creates multiple Options Pages with ACF Options Page Add-On
// http://www.advancedcustomfields.com/resources/filters/acfoptions_pagesettings/

function my_acf_options_page_settings( $settings ) {
	 $settings['title'] = 'Options';
	 $settings['pages'] = array('Call to Action', 'Slices', 'Footer');

	 return $settings;
}

add_filter('acf/options_page/settings', 'my_acf_options_page_settings');