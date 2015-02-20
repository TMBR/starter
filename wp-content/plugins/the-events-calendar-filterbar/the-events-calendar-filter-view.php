<?php
/*
Plugin Name: The Events Calendar: Filter Bar
Description: Creates an advanced filter panel on the frontend of your events list views.
Version: 3.9
Author: Modern Tribe, Inc.
Author URI: http://m.tri.be/25
Text Domain: tribe-events-filter-view
License: GPLv2
*/

/*
Copyright 2012 Modern Tribe Inc. and the Collaborators

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/


/**
 * Function used to load the the Filters View addon.
 *
 * @since 3.4
 * @author PaulHughes01
 *
 * @return void
 */
function TribeEventsFilterViewsLoad() {
	if ( class_exists( 'TribeEvents' ) && defined( 'TribeEvents::VERSION' ) ) {
		require_once( dirname( __FILE__ ) . '/lib/tribe-filter-view.class.php' );
		TribeEventsFilterView::init( __FILE__ );
	} else {
		add_action( 'admin_notices', 'tribe_events_filter_view_show_fail_message' );
	}
}

/**
 * Shows message if the plugin can't load due to TEC not being installed.
 *
 * @since 3.4
 * @author PaulHughes01
 *
 * @return void
 */
function tribe_events_filter_view_show_fail_message() {
	if ( current_user_can( 'activate_plugins' ) ) {
		$url = 'plugin-install.php?tab=plugin-information&plugin=the-events-calendar&TB_iframe=true';
		$title = __( 'The Events Calendar', 'tribe-events-filter-view' );
		echo '<div class="error"><p>'.sprintf( __( 'To begin using The Events Calendar: Advanced Filters, please install the latest version of <a href="%s" class="thickbox" title="%s">The Events Calendar</a>.', 'tribe-events-eventful-importer' ), $url, $title ) . '</p></div>';
	}
}

add_filter( 'tribe_tec_addons', array( 'TribeEventsFilterView', 'initAddon' ) );

add_action( 'plugins_loaded', 'TribeEventsFilterViewsLoad', 10 );

require_once( 'lib/tribe-filter-pue.class.php' );
new TribeEventsFilterPUE( __FILE__ );