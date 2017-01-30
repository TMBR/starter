<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class Tribe__Events__Pro__Shortcodes__Tribe_Events__Week {
	protected $shortcode;
	protected $date = '';

	public function __construct( Tribe__Events__Pro__Shortcodes__Tribe_Events $shortcode ) {
		$this->shortcode = $shortcode;
		$this->setup();
		$this->hooks();
	}

	protected function hooks() {
		add_action( 'tribe_events_pro_tribe_events_shortcode_pre_render', array( $this, 'shortcode_pre_render' ) );
		add_action( 'tribe_events_pro_tribe_events_shortcode_post_render', array( $this, 'shortcode_post_render' ) );
	}

	protected function setup() {
		Tribe__Events__Main::instance()->displaying = 'week';
		$this->set_current_month();
		$this->shortcode->prepare_default();


		Tribe__Events__Pro__Main::instance()->enqueue_pro_scripts();
		Tribe__Events__Pro__Template_Factory::asset_package( 'events-pro-css' );
		Tribe__Events__Pro__Template_Factory::asset_package( 'ajax-weekview' );

		$this->shortcode->set_template_object( new Tribe__Events__Pro__Templates__Week( $this->shortcode->get_query_args() ) );

	}

	protected function set_current_month() {
		$default = date_i18n( 'Y-m-d' );
		$this->date = $this->shortcode->get_url_param( 'eventDate' );

		if ( empty( $this->date ) ) {
			$this->date = $this->shortcode->get_attribute( 'date', $default );
		}

		// Expand "yyyy-mm" dates to "yyyy-mm-dd" format
		if ( preg_match( '/^[0-9]{4}-[0-9]{2}$/', $this->date ) ) {
			$this->date .= '-01';
		}
		// If we're not left with a "yyyy-mm-dd" date, override with the today's date
		elseif ( ! preg_match( '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $this->date ) ) {
			$this->date = $default;
		}

		$this->shortcode->update_query( array(
			'eventDate' => $this->date,
		) );
	}

	/**
	 * Filters the baseurl of ugly links
	 *
	 * @param string $url URL to filter
	 *
	 * @return string
	 */
	public function filter_baseurl( $url ) {
		return trailingslashit( get_home_url( null, $GLOBALS['wp']->request ) );
	}

	public function shortcode_pre_render() {
		add_filter( 'tribe_events_force_ugly_link', '__return_true' );
		add_filter( 'tribe_events_ugly_link_baseurl', array( $this, 'filter_baseurl' ) );
	}

	public function shortcode_post_render() {
		remove_filter( 'tribe_events_force_ugly_link', '__return_true' );
		remove_filter( 'tribe_events_ugly_link_baseurl', array( $this, 'filter_baseurl' ) );
	}
}
