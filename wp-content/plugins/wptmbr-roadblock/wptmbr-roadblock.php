<?php

/*
 *	Plugin Name: TMBR Roadblock Signup
 *	Plugin URI: http://www.wearetmbr.com
 *	Description: This plugin displays a subscribe form roadblock when users have viewed 3 pages on a website. If the user closes the window, this roadblock does not reappear for 60 days. 
 *	License: GPL2
 *	Version: 1.0
 *	Author: Galen Strasen, TMBR
 *
*/



/*
 * Assign global variables
 *
*/

$plugin_url = WP_PLUGIN_URL . '/wptmbr-roadblock';
$options = array();



/*
 * Add link to plugin in the admin menu
 * under 'Settings > TMBR Roadblock'
 *
*/

function wptmbr_roadblock_menu() {

	/* 
	 * Use the add_options_page function
	 * add_options_page( $page_tutle, $menu_title, $capability, $menu-slug, $function )
	 *
	*/

	add_options_page(
		'Official TMBR Roadblock Plugin',
		'TMBR Roadblock',
		'manage_option',
		'wptmbr-roadblock',
		'wptmbr_roadblock_options_page'
	);

}
add_action( 'admin_menu', 'wptmbr_roadblock_menu' );



function wptmbr_roadblock_options_page() {

	if( !current_user_can('manage_options') ) {
		wp_die( 'You do not have sufficient permission to access this page.')
	}

	echo '<p>Welcome to our plugin page!</p>';
}
?>