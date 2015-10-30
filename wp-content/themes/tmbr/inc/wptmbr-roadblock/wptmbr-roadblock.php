<?php

/*
 *	Plugin Name: Test TMBR Roadblock Signup
 *	Plugin URI: http://www.wearetmbr.com
 *	Description: This plugin displays a subscribe form roadblock when users have viewed 3 pages on a website. If the user closes the window, this roadblock does not reappear for 60 days. 
 *	License: GPL2
 *	Version: 1.0
 *	Author: TMBR
 *
*/




function wptmbr_roadblock_markup() {
	
	require( 'inc/frontend.php');

}
add_action( 'wp_footer', 'wptmbr_roadblock_markup');




function wptmbr_roadblock_enqueue() {

	wp_enqueue_style( 'wptmbr_roadblock_styles', get_template_directory_uri() . '/inc/wptmbr-roadblock/wptmbr-roadblock.css', array(), '', 'all' );

	wp_enqueue_script( 'cookie', get_template_directory_uri() . '/inc/wptmbr-roadblock/vendor/jquery.cookie.js',  array('jquery'), '', true );
	wp_enqueue_script( 'wptmbr_roadblock_script', get_template_directory_uri() . '/inc/wptmbr-roadblock/wptmbr-roadblock.js',  array('jquery'), '', true );

}
add_action( 'wp_enqueue_scripts', 'wptmbr_roadblock_enqueue');



