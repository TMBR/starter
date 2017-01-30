<?php
/**
 * Represents individual [tribe_events] shortcodes.
 *
 * Notice that we look for (and set) the "tribe_events_display" URL parameter in preference
 * to "eventDisplay". This is because "eventDisplay" is registered as a public query var in
 * Tribe__Events__Main::eventQueryVars(). When used on a static homepage, the result can be
 * incorrect parsing of the query.
 */
class Tribe__Events__Pro__Shortcodes__Tribe_Events {
	/**
	 * Container for the shortcode attributes.
	 *
	 * @var array
	 */
	protected $atts = array();

	/**
	 * Container for the relevant template manager. This may not always be needed
	 * and so may be empty.
	 *
	 * @var object|null
	 */
	protected $template_object;

	/**
	 * @var object|null
	 */
	protected $view_handler;

	/**
	 * @var string
	 */
	protected $output = '';

	/**
	 * Query arguments required to setup the requested view.
	 *
	 * @var array
	 */
	protected $query_args = array();

	/**
	 * The strings that the shortcode considers to be "truthy" in the context of
	 * various attributes.
	 *
	 * @var array
	 */
	protected $truthy_values = array();


	/**
	 * Generates output for the [tribe_events] shortcode.
	 *
	 * @param $atts
	 */
	public function __construct( $atts ) {
		$this->setup( $atts );
		$this->prepare();
		$this->render();
	}

	/**
	 * Parse the provided attributes and hook into the shortcode processes.
	 *
	 * @param $atts
	 */
	protected function setup( $atts ) {
		$defaults = array(
			'date'      => '',
			'tribe-bar' => 'true',
			'view'      => '',
			'category'  => '',
			'cat'       => '',
			'featured'  => 'false',
		);

		$this->atts = shortcode_atts( $defaults, $atts, 'tribe_events' );

		// reassign 'cat' to 'category'
		if ( ! empty( $this->atts['cat'] ) ) {
			$this->atts['category'] = $this->atts['cat'];
		}

		$this->set_view_attribute();

		add_action( 'tribe_events_pro_tribe_events_shortcode_prepare', array( $this, 'prepare_query' ) );
		add_action( 'tribe_events_pro_tribe_events_shortcode_prepare_day', array( $this, 'prepare_day' ) );
		add_action( 'tribe_events_pro_tribe_events_shortcode_prepare_list', array( $this, 'prepare_list' ) );
		add_action( 'tribe_events_pro_tribe_events_shortcode_prepare_map', array( $this, 'prepare_map' ) );
		add_action( 'tribe_events_pro_tribe_events_shortcode_prepare_month', array( $this, 'prepare_month' ) );
		add_action( 'tribe_events_pro_tribe_events_shortcode_prepare_photo', array( $this, 'prepare_photo' ) );
		add_action( 'tribe_events_pro_tribe_events_shortcode_prepare_week', array( $this, 'prepare_week' ) );
		add_action( 'tribe_events_pro_tribe_events_shortcode_post_render', array( $this, 'reset_query' ) );
	}

	/**
	 * Sets the view attribute.
	 *
	 * In priority order, will use one of the following to set the view attribute:
	 *
	 *     1) The value of "eventDisplay" in the URL query, if set and if valid
	 *     2) The value of the "view" attribute provided to the shortcode, if set and if valid
	 *     3) The first view that is available
	 *     4) Month view
	 */
	protected function set_view_attribute() {
		$valid_views = wp_list_pluck( tribe_events_get_views(), 'displaying' );
		$url_view    = $this->get_url_param( 'tribe_event_display' );
		$view_attr   = $this->get_attribute( 'view', 'month' );

		// If tribe_event_display is "past", we need to grab the view from the action parameter
		if ( 'past' === $url_view ) {
			$url_view = str_replace( 'tribe_', '', $this->get_url_param( 'action' ) );

			// Convert the "geosearch" portion of "tribe_geosearch" to "map" so Map view can properly be initialized
			// @TODO: restructure map view to use tribe_map rather than tribe_geosearch
			if ( 'geosearch' === $url_view ) {
				$url_view = 'map';
			}
		}

		// Look first of all at the URL query for a valid view
		if ( in_array( $url_view, $valid_views ) ) {
			$this->atts['view'] = $url_view;
			return;
		}

		// Else fallback on the view attribute supplied to the shortcode
		if ( in_array( $view_attr, $valid_views ) ) {
			$this->atts['view'] = $view_attr;
			return;
		}

		// Otherwise, use the first view that *is* available
		if ( ! empty( $valid_views ) ) {
			$this->atts['view'] = current( $valid_views );
			return;
		}

		// If all else fails, we'll try to use month view even if not currently activated
		$this->atts['view'] = 'month';
	}

	/**
	 * Facilitates preparation of template classes and anything else required to setup
	 * a given view or support particular attributes that have been set.
	 */
	protected function prepare() {
		/**
		 * Provides an early opportunity for setup work to be performed.
		 *
		 * @param Tribe__Events__Pro__Shortcodes__Tribe_Events $shortcode
		 */
		do_action( 'tribe_events_pro_tribe_events_shortcode_prepare', $this );

		/**
		 * Provides an opportunity for template classes to be instantiated and/or
		 * any other required setup to be performed, for a specific view.
		 *
		 * @param Tribe__Events__Pro__Shortcodes__Tribe_Events $shortcode
		 */
		do_action( 'tribe_events_pro_tribe_events_shortcode_prepare_' . $this->atts[ 'view' ], $this );

		/**
		 * Provides an opportunity for template classes to be instantiated and/or
		 * any other required setup to be performed for views in general.
		 *
		 * @param string $view
		 * @param Tribe__Events__Pro__Shortcodes__Tribe_Events $shortcode
		 */
		do_action( 'tribe_events_pro_tribe_events_shortcode_prepare_view', $this->atts[ 'view' ], $this );
	}

	/**
	 * Prepares day view.
	 *
	 */
	public function prepare_day() {
		if ( ! class_exists( 'Tribe__Events__Template__Day' ) ) {
			return;
		}

		$this->view_handler = new Tribe__Events__Pro__Shortcodes__Tribe_Events__Day( $this );
	}

	/**
	 * Prepares list view.
	 */
	public function prepare_list() {
		if ( ! class_exists( 'Tribe__Events__Template__List' ) ) {
			return;
		}

		$this->view_handler = new Tribe__Events__Pro__Shortcodes__Tribe_Events__List( $this );
	}

	/**
	 * Prepares map view.
	 *
	 */
	public function prepare_map() {
		if ( ! class_exists( 'Tribe__Events__Pro__Templates__Map' ) ) {
			return;
		}

		tribe_get_template_part( 'pro/map/gmap-container' );

		$this->view_handler = new Tribe__Events__Pro__Shortcodes__Tribe_Events__Map( $this );
	}

	/**
	 * Prepares month view.
	 */
	public function prepare_month() {
		if ( ! class_exists( 'Tribe__Events__Template__Month' ) ) {
			return;
		}

		$this->view_handler = new Tribe__Events__Pro__Shortcodes__Tribe_Events__Month( $this );
	}

	/**
	 * Prepares photo view.
	 *
	 */
	public function prepare_photo() {
		if ( ! class_exists( 'Tribe__Events__Pro__Templates__Photo' ) ) {
			return;
		}

		$this->view_handler = new Tribe__Events__Pro__Shortcodes__Tribe_Events__Photo( $this );
	}

	/**
	 * Prepares week view.
	 *
	 */
	public function prepare_week() {
		if ( ! class_exists( 'Tribe__Events__Pro__Templates__Week' ) ) {
			return;
		}

		$this->view_handler = new Tribe__Events__Pro__Shortcodes__Tribe_Events__Week( $this );
	}

	/**
	 * Sets up the basic properties for an event view query.
	 */
	public function prepare_query() {
		$this->update_query( array(
			'post_type'         => Tribe__Events__Main::POSTTYPE,
			'eventDate'         => $this->get_attribute( 'date', $this->get_url_param( 'date' ) ),
			'eventDisplay'      => $this->get_attribute( 'view' ),
			'tribe_events_cat'  => $this->atts[ 'category' ],
			'featured'          => $this->is_attribute_truthy( 'featured' ),
		) );
	}

	/**
	 * Take care of common setup needs including enqueing various assets required by the default views.
	 */
	public function prepare_default() {
		global $wp_query;

		/**
		 * We overwrite the global $wp_query object to facilitate embedding the requested view (the
		 * original will be restored during tribe_events_pro_tribe_events_shortcode_post_render):
		 * this isn't ideal, but further restructuring of our template classes and event views would
		 * be needed to avoid it.
		 *
		 * @see $this->reset_query()
		 * @todo revise in a future release
		 */
		$wp_query = new WP_Query( $this->query_args );

		// Assets required by all our supported views
		wp_enqueue_script( 'jquery' );
		Tribe__Events__Template_Factory::asset_package( 'bootstrap-datepicker' );
		Tribe__Events__Template_Factory::asset_package( 'calendar-script' );
		Tribe__Events__Template_Factory::asset_package( 'jquery-resize' );
		Tribe__Events__Template_Factory::asset_package( 'events-css' );
		Tribe__Events__Pro__Template_Factory::asset_package( 'events-pro-css' );

		// Tribe Events Bar support
		if ( $this->is_attribute_truthy( 'tribe-bar', true ) ) {
			add_filter( 'tribe_get_option', array( $this, 'filter_tribe_disable_bar' ), 10, 2 );

			// Make sure the filters have been initialized
			tribe_events_get_filters();

			add_filter( 'tribe-events-bar-should-show', array( $this, 'enable_tribe_bar' ) );

			remove_action( 'tribe_events_bar_before_template', array( Tribe__Events__Bar::instance(), 'disabled_bar_before' ) );
			remove_action( 'tribe_events_bar_after_template', array( Tribe__Events__Bar::instance(), 'disabled_bar_after' ) );

			Tribe__Events__Template_Factory::asset_package( 'jquery-placeholder' );
			Tribe__Events__Pro__Template_Factory::asset_package( 'ajax-maps' );
			Tribe__Events__Template_Factory::asset_package( 'jquery-resize' );

			add_action( 'tribe_events_bar_before_template', array( Tribe__Events__Bar::instance(), 'disabled_bar_before' ) );
			add_action( 'tribe_events_bar_after_template', array( Tribe__Events__Bar::instance(), 'disabled_bar_after' ) );

			remove_filter( 'tribe_get_option', array( $this, 'filter_tribe_disable_bar' ) );
		}

		// Add the method responsible for rendering each of the default supported views
		add_filter( 'tribe_events_pro_tribe_events_shortcode_output', array( $this, 'render_view' ) );

		// View selector URLs will need to be adjusted (so that the user is not taken to /events/new-view/)
		add_filter( 'tribe-events-bar-views', array( $this, 'modify_view_urls' ), 100 );
	}

	/**
	 * Filters the tribeDisableTribeBar value to make sure tribe bar filters initialized
	 *
	 * @param string $value Option value
	 * @param string $option_name Option name
	 *
	 * @return boolean
	 */
	public function filter_tribe_disable_bar( $value, $option_name ) {
		if ( 'tribeDisableTribeBar' !== $option_name ) {
			return $value;
		}

		return false;
	}

	/**
	 * Expects to be called during "tribe-events-bar-should-show" - will unhook itself
	 * and return true.
	 *
	 * @return bool true
	 */
	public function enable_tribe_bar() {
		remove_filter( 'tribe-events-bar-should-show', array( $this, 'enable_tribe_bar' ) );
		return true;
	}

	/**
	 * Sets the query arguments needed to facilitate a custom request.
	 *
	 * @param array $arguments
	 */
	public function update_query( array $arguments ) {
		$this->query_args = array_merge( $this->query_args, $arguments );
	}

	/**
	 * Returns the currently configured query arguments for the current embedded view.
	 *
	 * @return array
	 */
	public function get_query_args() {
		return $this->query_args;
	}

	/**
	 * @internal
	 *
	 * @param string $param
	 * @param mixed  $default = null
	 *
	 * @return mixed
	 */
	public function get_url_param( $param, $default = null ) {
		return isset( $_GET[ $param ] ) ? $_GET[ $param ] : $default;
	}

	/**
	 * Once the view has been rendered, restore the origin WP_Query object.
	 */
	public function reset_query() {
		remove_action( 'tribe_events_pro_tribe_events_shortcode_post_render', array( $this, 'reset_query' ) );
		wp_reset_query();
	}

	/**
	 * Returns the currently set shortcode attributes.
	 *
	 * @return array
	 */
	public function get_attributes() {
		return $this->atts;
	}

	/**
	 * Returns the value of the specified shortcode attribute or else returns
	 * $default if $name is not set.
	 *
	 * @param string $name
	 * @param mixed  $default = null
	 *
	 * @return mixed
	 */
	public function get_attribute( $name, $default = null ) {
		return ! empty( $this->atts[ $name ] ) ? trim( $this->atts[ $name ] ) : $default;
	}

	/**
	 * Sets the current state of the shortcode based on URL parameters
	 */
	public function set_current_page() {
		$paged   = $this->get_url_param( 'tribe_paged' );
		$display = $this->get_url_param( 'tribe_event_display' );

		if ( ! $paged && ! $display ) {
			return;
		}

		$this->update_query( array(
			'paged' => $paged,
		) );

		if ( 'past' === $display ) {
			$this->update_query( array(
				'eventDisplay' => 'past',
				'order' => 'DESC',
			) );
		}
	}

	/**
	 * Tests to see if the specified attribute has a truthy value (typically "on",
	 * "true", "yes" or "1").
	 *
	 * In cases where the attribute is not set, it will return false unless
	 * $true_by_default is set to true.
	 *
	 * @param string $name
	 * @param bool   $true_by_default = false
	 *
	 * @return bool
	 */
	public function is_attribute_truthy( $name, $true_by_default = false ) {
		// If the attribute is not set, return the default
		if ( ! isset( $this->atts[ $name ] ) ) {
			return (bool) $true_by_default;
		}

		$value = strtolower( $this->get_attribute( $name ) );
		return in_array( $value, $this->get_truthy_values() );
	}

	/**
	 * Returns an array of strings that can be regarded as "truthy".
	 *
	 * @return array
	 */
	protected function get_truthy_values() {
		if ( empty( $this->truthy_values ) ) {
			/**
			 * Allows the set of strings regarded as truthy (in the context of the [tribe_events]
			 * shortcode attributes) to be altered.
			 *
			 * These should generally be lowercase strings for those languages where such a thing
			 * makes sense.
			 *
			 * @param array $truthy_values
			 */
			$this->truthy_values = (array) apply_filters( 'tribe_events_pro_tribe_events_shortcode_truthy_values', array(
				'1',
				'on',
				'yes',
				'true',
			) );
		}

		return $this->truthy_values;
	}

	/**
	 * Returns the current template class object, if one has been found and loaded.
	 *
	 * @return object|null
	 */
	public function get_template_object() {
		return $this->template_object;
	}

	/**
	 * Sets the template object being used to generate the embedded view.
	 *
	 * @param object $template_object
	 */
	public function set_template_object( $template_object ) {
		if ( ! is_object( $template_object ) ) {
			_doing_it_wrong( __METHOD__, __( '$template_object is expected to be an actual object', 'the-events-calendar' ), '4.3' );
			return;
		}

		$this->template_object = $template_object;
	}

	/**
	 * Returns the object responsible for handling the current view, if one is needed
	 * and has been set.
	 *
	 * @return null|object
	 */
	public function get_view_handler() {
		return $this->view_handler;
	}

	/**
	 * Triggers rendering of the currently requested view.
	 */
	protected function render() {
		/**
		 * Triggers the rendering of the requested view.
		 *
		 * @param string $html
		 * @param string $view
		 * @param Tribe__Events__Pro__Shortcodes__Tribe_Events $shortcode
		 */
		$this->output = (string) apply_filters( 'tribe_events_pro_tribe_events_shortcode_output', '', $this->atts[ 'view' ], $this );
	}

	/**
	 * For default supported views, performs rendering and returns the result.
	 */
	public function render_view() {
		$attributes = array();

		/**
		 * Fires before the embedded view is rendered.
		 *
		 * @param Tribe__Events__Pro__Shortcodes__Tribe_Events $shortcode
		 */
		do_action( 'tribe_events_pro_tribe_events_shortcode_pre_render', $this );

		ob_start();

		$this->get_template_object()->add_input_hash();
		$attributes[] = 'id="tribe-events"';
		$attributes[] = 'class="' . $this->get_wrapper_classes() . '"';

		if ( ! empty( $this->query_args['tribe_events_cat'] ) ) {
			$attributes[] = 'data-category="' . esc_attr( $this->query_args['tribe_events_cat'] ) . '"';
		}

		// Creates id='tribe-events' container
		echo '<div ' . implode( ' ', $attributes ) . '>';

		// Include the tribe bar HTML if required
		if ( $this->is_attribute_truthy( 'tribe-bar', true ) ) {
			Tribe__Events__Bar::instance()->load_script();
			tribe_get_template_part( 'modules/bar' );
		}

		tribe_get_view( $this->get_template_object()->view_path );
		echo '</div>';

		$html = ob_get_clean();

		/**
		 * Fires after the embedded view is rendered.
		 *
		 * @param Tribe__Events__Pro__Shortcodes__Tribe_Events $shortcode
		 */
		do_action( 'tribe_events_pro_tribe_events_shortcode_post_render', $this );

		return $html;
	}

	/**
	 * @param array $views
	 *
	 * @return array
	 */
	public function modify_view_urls( array $views ) {
		$embed_url = get_home_url( null, $GLOBALS['wp']->request );

		foreach ( $views as &$view_data ) {
			$view_data['url'] = add_query_arg( 'tribe_event_display', $view_data[ 'displaying' ], $embed_url );
		}

		return $views;
	}

	/**
	 * Returns a set of (already escaped) CSS class names intended for use in the div
	 * wrapping the shortcode output.
	 *
	 * @return string
	 */
	protected function get_wrapper_classes() {
		$category = '';
		$view = '';
		if ( isset( $this->atts[ 'view' ] ) ) {
			$view = 'view-' . esc_attr( $this->atts[ 'view' ] );
		}

		if ( isset( $this->atts[ 'category' ] ) ) {
			$category = 'category-' . $this->atts[ 'category' ];
		}
		$classes = array(
			'tribe-events-shortcode',
			'tribe-events-view-wrapper',
			esc_attr( $view ),
			esc_attr( $category ),
			$this->is_attribute_truthy( 'tribe-bar', true ) ? 'tribe-bar' : 'tribe-bar-hidden',
		);

		/**
		 * Sets the CSS classes applied to the [tribe_events] wrapper div.
		 *
		 * @param array $classes
		 * @param Tribe__Events__Pro__Shortcodes__Tribe_Events $shortcode
		 */
		$classes = (array) apply_filters( 'tribe_events_pro_tribe_events_shortcode_wrapper_classes', $classes, $this );

		$classes = implode( ' ', array_filter( $classes ) );
		return esc_attr( $classes );
	}

	/**
	 * Returns the output of this shortcode.
	 *
	 * @return string
	 */
	public function output() {
		return $this->output;
	}
}
