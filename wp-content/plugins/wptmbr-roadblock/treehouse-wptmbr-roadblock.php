<?php




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
	if( isset( $_POST['wptreehouse_form_submitted'] ) ) {

		$hidden_field = esc_html( $_POST['wptreehouse_form_submitted'] );

		if( $hidden_field == 'Y' ) {
			$wptreehouse_username = esc_html( $_POST['wptreehouse_username'] );

			$options['wptreehouse_username'] = $wptreehouse_username;
			$options['last_updated'] = time();

			update_option( 'wptreehouse_badges', $options );

		}

	}

	$options = get_option( 'wptreehouse_badges');

	if( $options != '') {
		$wptreehouse_username = $options['wptreehouse_username'];
	}

	require( 'inc/options-page-wrapper.php' );
}


function wptmbr_roadblock_styles() {


	wp_enqueue_style( 'wptmbr_roadblock_styles', plugins_url( 'wptmbr-roadblock/wptmbr-roadblock.css'));


}

add_action( 'admin_head', 'wptmbr_roadblock_styles');


?>