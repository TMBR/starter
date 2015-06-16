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
		'manage_options',
		'wptmbr-roadblock',
		'wptmbr_roadblock_options_page'
	);

}
add_action( 'admin_menu', 'wptmbr_roadblock_menu' );



function wptmbr_roadblock_options_page() {

	if( !current_user_can('manage_options') ) {
		wp_die( 'You do not have sufficient permission to access this page.');
	}

	global $plugin_url;
	global $options;

	if( isset( $_POST['wptmbr_form_submitted'] ) ) {

		$hidden_field = esc_html( $_POST['wptmbr_form_submitted'] );

		if( $hidden_field == 'Y' ) {
			echo $_POST['wptmbr_header'];
			$wptmbr_header = esc_html( $_POST['wptmbr_header'] );
			$wptmbr_text = esc_html( $_POST['wptmbr_text'] );
			$wptmbr_gfid = esc_html( $_POST['wptmbr_gfid'] );

			$options['wptmbr_header'] = $wptmbr_header;
			$options['wptmbr_text'] = $wptmbr_text;
			$options['wptmbr_gfid'] = $wptmbr_gfid;
			$options['last_updated'] = time();

			update_option( 'wptmbr_roadblock', $options );

		}

	}

	$options = get_option( 'wptmbr_roadblock');

	if( $options != '') {
		$wptmbr_header = $options['wptmbr_header'];
		$wptmbr_text = $options['wptmbr_text'];
		$wptmbr_gfid = $options['wptmbr_gfid'];
	}

	require( 'inc/options-page-wrapper.php' );
}

function wptmbr_roadblock_markup() {

	require( 'inc/modal-markup.php');

}

add_action( 'wp_footer', 'wptmbr_roadblock_markup');
function wptmbr_roadblock_styles() {

	wp_enqueue_style( 'wptmbr_roadblock_styles', plugins_url( 'wptmbr-roadblock/wptmbr-roadblock.css'));

}

add_action( 'admin_head', 'wptmbr_roadblock_styles');


?>