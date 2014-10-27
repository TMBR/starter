<?php

/**
 * Check if the hook is scheduled - if not, schedule it.
 *
 * !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 * !!! If the scheduled time is in the past, wp_schedule_event() will cause this to run immediately, and then again at the scheduled time. !!!
 * !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 *
 * The local time you want it to run needs to be offset by the timezone that WordPress has set.
 */
function my_af_setup_daily_schedule() {
	/* must have this check here, b/c although a new cron event won't be added without it,
	 * the wp_schedule_event() function triggers the action to run immediately, even if
	 * set for a different time of day. */
	if ( ! wp_next_scheduled( 'af_reset_weather_override' ) ) {
		$local_hour_to_run = 1;
		$gmt_hour_to_run = $local_hour_to_run - wp_timezone_override_offset();
		wp_schedule_event(
			strtotime( $gmt_hour_to_run . 'am', strtotime( 'yesterday' ) ),
			'daily',
			'af_reset_weather_override'
		);
	}
}
add_action( 'init', 'my_af_setup_daily_schedule' );

// remove the weather override at the proper action
add_action( 'af_reset_weather_override', function() {
	update_option( 'options_weather_icon_override', false );
} );

// See if we have an override set, if so, use it.
add_filter(
	'tmbr_weather_current_icon',
	function( $icon_str, $weather_obj ) {
		$_icon = get_option( 'options_weather_icon_override' );
		if ( !empty( $_icon ) && strtolower( $_icon ) != 'default')
		{
			$icon_str = $_icon;
		}
		return $icon_str;
	},
	10,
	2
);
