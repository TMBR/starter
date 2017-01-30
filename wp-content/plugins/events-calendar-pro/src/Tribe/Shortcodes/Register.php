<?php


/**
 * Registers shortcodes handlers for each of the widget wrappers.
 */
class Tribe__Events__Pro__Shortcodes__Register {

	public function __construct() {
		add_shortcode( 'tribe_mini_calendar', array( $this, 'mini_calendar' ) );
		add_shortcode( 'tribe_events_list', array( $this, 'events_list' ) );
		add_shortcode( 'tribe_featured_venue', array( $this, 'featured_venue' ) );
		add_shortcode( 'tribe_event_countdown', array( $this, 'event_countdown' ) );
		add_shortcode( 'tribe_this_week', array( $this, 'this_week' ) );
		add_shortcode( 'tribe_events', array( $this, 'tribe_events' ) );
		add_shortcode( 'tribe_event_inline', array( $this, 'tribe_inline' ) );
	}

	public function mini_calendar( $atts ) {
		$wrapper = new Tribe__Events__Pro__Shortcodes__Mini_Calendar( $atts );

		return $wrapper->output;
	}

	public function events_list( $atts ) {
		$wrapper = new Tribe__Events__Pro__Shortcodes__Events_List( $atts );

		return $wrapper->output;
	}

	public function featured_venue( $atts ) {
		$wrapper = new Tribe__Events__Pro__Shortcodes__Featured_Venue( $atts );

		return $wrapper->output;
	}

	public function event_countdown( $atts ) {
		$wrapper = new Tribe__Events__Pro__Shortcodes__Event_Countdown( $atts );

		return $wrapper->output;
	}

	/**
	 * @param $atts
	 *
	 * @return string
	 */
	public function this_week( $atts ) {
		$wrapper = new Tribe__Events__Pro__Shortcodes__This_Week( $atts );

		return $wrapper->output;
	}

	/**
	 * Handler for the [tribe_events] shortcode.
	 *
	 * Please note that the shortcode should not be used alongside a regular event archive
	 * view nor should it be used more than once in the same request - or else breakages may
	 * occur. We try to limit accidental breakages by returning an empty string if we detect
	 * any of the above scenarios.
	 *
	 * This limitation can be lifted once our CSS, JS and template classes are refactored to
	 * support multiple instances of each view in the same request.
	 *
	 * @param $atts
	 *
	 * @return string
	 */
	public function tribe_events( $atts ) {
		static $deployed = false;

		if ( tribe_is_event_query() || $deployed ) {
			return '';
		}

		$shortcode = new Tribe__Events__Pro__Shortcodes__Tribe_Events( $atts );
		$deployed  = true;

		return $shortcode->output();
	}

	/**
	 * Handler for Inline Event Content Shortcode
	 *
	 * @param $atts
	 * @param $content
	 * @param $tag
	 *
	 * @return string
	 */
	public function tribe_inline( $atts, $content, $tag ) {

		$shortcode = new Tribe__Events__Pro__Shortcodes__Tribe_Inline( $atts, $content, $tag );

		return $shortcode->output();
	}
}
