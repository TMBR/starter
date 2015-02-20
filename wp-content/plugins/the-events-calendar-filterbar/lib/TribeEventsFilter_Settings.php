<?php

/**
 * Class TribeEventsFilter_Settings
 */
class TribeEventsFilter_Settings {
	const OPTION_ACTIVE_FILTERS = 'tribe_events_filters_current_active_filters';

	public function set_hooks() {
		add_action( 'admin_enqueue_scripts', array( $this, 'addAdminScriptsAndStyles' ) );
		add_action( 'tribe_settings_do_tabs', array( $this, 'addSettingsTab' ), 10, 0 );
		add_action( 'tribe_settings_after_content_tab_filter-view', array( $this, 'addSettingsContent' ) );
		add_action( 'tribe_settings_save_tab_filter-view', array( $this, 'save_settings_tab' ), 10, 0 );
		add_action( 'wp_before_admin_bar_render', array( $this, 'add_toolbar_item' ), 12 );
	}


	public function addAdminScriptsAndStyles() {
		global $current_screen;

		// settings screen
		if (isset($current_screen->id) && $current_screen->id == 'tribe_events_page_tribe-events-calendar') {
    	    wp_enqueue_style( 'TribeEventsFilterAdmin-css', trailingslashit( plugins_url( '', dirname( __FILE__ ) ) ) . 'resources/filter-admin.css', array(), apply_filters( 'tribe_events_filters_css_version', TribeEventsFilterView::VERSION ) );
		}

	}
	/**
	 * Add the Filters settings tab.
	 *
	 * @return void
	 */
	public function addSettingsTab() {
		$fields = $this->get_field_definitions();
		new TribeSettingsTab( 'filter-view', __( 'Filters', 'tribe-events-filter-view' ), array( 'priority' => 36, 'fields' => $fields ) );
	}


	/**
	 * Add the content to the settings tab.
	 *
	 * @return void
	 */
	public function addSettingsContent() {
		require_once( TribeEventsFilterView::plugin_path('admin-views/tribe-filter-view-options.php') );
	}

	public function render_available_filters_box() {
		$filters = TribeEventsFilterView::instance()->get_registered_filters();
		$current_filters = TribeEventsFilterView::instance()->get_active_filters();
		include( TribeEventsFilterView::plugin_path('admin-views/settings-field-available-filters.php') );
	}

	public function render_active_filters_box() {
		$filters = TribeEventsFilterView::instance()->get_registered_filters();
		$sorted_filters = array();
		foreach ( TribeEventsFilterView::instance()->get_active_filters() as $slug ) {
			if ( isset($filters[$slug]) ) {
				$sorted_filters[$slug] = $filters[$slug];
				unset($filters[$slug]);
			}
		}
		$filters = array_merge($sorted_filters, $filters);
		include( TribeEventsFilterView::plugin_path('admin-views/settings-field-active-filters.php') );
	}

	/**
	 * Save submitted settings from the filters tab
	 * @return void
	 */
	public function save_settings_tab() {
		$active_filters = array();
		$active_filter_slugs = (array)( isset( $_POST['tribe_active_filters'] ) ? $_POST['tribe_active_filters'] : array() );
		foreach ( $active_filter_slugs as $filter_slug ) {
			$filter_options = (array)( isset( $_POST['tribe_filter_options'][$filter_slug] ) ? $_POST['tribe_filter_options'][$filter_slug] : array() );
			$active_filters[$filter_slug] = $filter_options;
		}
		uasort( $active_filters, array( $this, 'compare_filters_by_priority' ) );
		update_option( self::OPTION_ACTIVE_FILTERS, $active_filters );
	}

	private function compare_filters_by_priority( $a, $b ) {
		if ( $a['priority'] == $b['priority'] ) {
			return 0;
		}
		return ( $a['priority'] < $b['priority'] ) ? -1 : 1;
	}

	private function get_field_definitions() {
		$fields = array(
			'events_filters_section_title' => array(
				'type' => 'html',
				'html' => '<h3>' . __('Filters', 'tribe-events-filter-view') . '</h3>',
			),
			'events_filters_section_description' => array(
				'type' => 'html',
				'html' => '<p class="description">' . __('The settings below allow you to enable or disable front-end event filters. Uncheck the box to hide the filter. Drag and drop active filters to re-arrange them.', 'tribe-events-filter-view') . '</p>'
				        . '<p class="description">' . __('Expand an active filter to edit the label and choose from a subset of input types (dropdown, select, range slider, checkbox and radio).', 'tribe-events-filter-view') . '</p>',
			),
			'events_filters_available_filters' => array(
				'type' => 'html',
				'display_callback' => array( $this, 'render_available_filters_box' ),
			),
			'events_filters_active_filters' => array(
				'type' => 'html',
				'display_callback' => array( $this, 'render_active_filters_box' ),
			),
			'events_filters_layout' => array(
				'type' => 'radio',
				'label'           => __( 'Filters Layout', 'tribe-events-filter-view' ),
				'default'         => 'vertical',
				'options' => array(
					'vertical' => __( 'Vertical', 'tribe-events-filter-view' ),
					'horizontal' => __( 'Horizontal', 'tribe-events-filter-view' ),
				),
				'validation_type' => 'options',
			),
			'events_filters_default_state' => array(
				'type' => 'radio',
				'label'           => __( 'Filters Default State', 'tribe-events-filter-view' ),
				'default'         => 'closed',
				'options' => array(
					'closed' => __( 'Closed', 'tribe-events-filter-view' ),
					'open' => __( 'Open', 'tribe-events-filter-view' ),
				),
				'validation_type' => 'options',
			)						
		);
		$fields = apply_filters( 'tribe-event-filters-settings-fields', $fields );
		return $fields;
	}

	/**
	 * Adds a link to the Filter Settings tab in the admin toolbar.
	 */
	public function add_toolbar_item() {
		global $wp_admin_bar;
		$parent = 'tribe-events-settings';
		$link = trailingslashit( get_admin_url() ) . 'edit.php?post_type=' . TribeEvents::POSTTYPE .'&page=tribe-events-calendar&tab=filter-view';

		if ( ! current_user_can( 'manage_options' ) || null === $wp_admin_bar->get_node( $parent ) ) return;

		$wp_admin_bar->add_menu( array(
			'id' => 'tribe-events-filter-settings',
			'parent' => $parent,
			'href' => $link,
			'title' => __( 'Filter Bar', 'tribe-events-filter-view' )
		) );
	}
}
 