<?php

/*
 *	Plugin Name: TMBR Roadblock Signup
 *	Plugin URI: http://www.wearetmbr.com
 *	Description: This plugin uses a cookie to display a subscribe form roadblock once users have clicked through 3 pages on website. 
 *	License: GPL2
 *	Version: 1.0
 *	Author: TMBR - A CREATIVE AGENCY
 *
*/



/* 	ASSIGN GLOBAL VARIABLES
===================================== */
$plugin_url = WP_PLUGIN_URL . '/wptmbr-roadblock';



/*	ADD LINK TO PLUGIN SETTINGS 
	IN THE ADMIN MENU
===================================== */

function wptmbr_roadblock_menu() {

	add_options_page(
		'Official TMBR Roadblock Plugin',
		'TMBR Roadblock',
		'manage_options',
		'wptmbr-roadblock',
		'wptmbr_roadblock_options_page'
	);

}
add_action( 'admin_menu', 'wptmbr_roadblock_menu' );



/* 	SET UP PLUGIN SETTINGS PAGE
===================================== */
function wptmbr_roadblock_options_page() {

	if( !current_user_can('manage_options') ) {
		wp_die( 'You do not have sufficient permission to access this page.');
	}

	if( isset( $_POST['wptmbr_form_submitted'] ) ) {

		$hidden_field = $_POST['wptmbr_form_submitted'];

		if( $hidden_field == 'Y' ) {
			
			$wptmbr_header = wp_filter_nohtml_kses( $_POST['wptmbr_header'] );
			$wptmbr_text = wp_filter_nohtml_kses( $_POST['wptmbr_text'] );
			$wptmbr_gfid = intval( $_POST['wptmbr_gfid'] );

			$options = array();

			$options['wptmbr_header'] = $wptmbr_header;
			$options['wptmbr_text'] = $wptmbr_text;
			$options['wptmbr_gfid'] = $wptmbr_gfid;
			$options['last_updated'] = time();

			update_option( 'wptmbr_roadblock', $options );

		}

	}

	$options = get_option( 'wptmbr_roadblock' );

	if( !empty ( $options ) && is_array( $options ) ) {
		$wptmbr_header = $options['wptmbr_header'];
		$wptmbr_text = $options['wptmbr_text'];
		$wptmbr_gfid = $options['wptmbr_gfid'];
	}

	require( 'inc/options-page-wrapper.php' );
}



/* 	GET MARKUP FOR MODAL
===================================== */
function wptmbr_roadblock_markup() {
	
	$options = get_option( 'wptmbr_roadblock' );
	
	if( empty ( $options ) || !is_array( $options ) ) {
		return;
	}

	$wptmbr_header = $options['wptmbr_header'];
	$wptmbr_text = $options['wptmbr_text'];
	$wptmbr_gfid = $options['wptmbr_gfid'];

	require( 'inc/modal-markup.php' );

}
add_action( 'wp_footer', 'wptmbr_roadblock_markup');



/* 	ENQUEUE NECESSARY SCRIPTS & STYLES
===================================== */
function wptmbr_roadblock_enqueue() {

	wp_enqueue_style( 'wptmbr_roadblock_styles', plugins_url( 'wptmbr-roadblock/wptmbr-roadblock.css' ) );

	wp_enqueue_script( 'jquery_cookie', plugins_url( 'wptmbr-roadblock/vendor/jquery.cookie.js' ), array( 'jquery' ), '', true ); 
	wp_enqueue_script( 'wptmbr_roadblock_script', plugins_url( 'wptmbr-roadblock/wptmbr-roadblock.js' ), array( 'jquery' ), '', true ); 

}
add_action( 'wp_enqueue_scripts', 'wptmbr_roadblock_enqueue');


?>