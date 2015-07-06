<?php

/*
// ACF PRO Options pages
-----------------------------
> http://www.advancedcustomfields.com/resources/register-multiple-options-pages/
> http://www.advancedcustomfields.com/resources/acf_add_options_sub_page/

*/

if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Global Settings',
		'menu_title'	=> 'Global Settings',
		'menu_slug' 	=> 'global-settings',
		'capability'	=> 'edit_posts',
		'icon_url'		=> 'dashicons-admin-site',
		'redirect'		=> false // This allows the parent to have it's own page instead of redirecting to the first child.
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'global-settings',
		'capability'	=> 'manage_options'
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'global-settings',
		'capability'	=> 'manage_options'
	));

}




/*
// ACF PRO Options Page Settings: 
This Hook Allows you to Modify Settings for the Options Page Add-on
-----------------------------------------------------------------------
> http://www.advancedcustomfields.com/resources/filters/acfoptions_pagesettings/


// this example will change the menu item title to 'Global Settings' and add 3 sub pages!

function my_acf_options_page_settings( $settings ) {
	 $settings['title'] = 'Global Settings';
	 $settings['pages'] = array('Header', 'Sidebar', 'Footer');

	 return $settings;
}

add_filter('acf/options_page/settings', 'my_acf_options_page_settings');
*/