<?php

/**
 * Class TribeEventsFilter_Venue
 */
class TribeEventsFilter_Venue extends TribeEventsFilter {
	public $type = 'checkbox';

	public function get_admin_form() {
		$title = $this->get_title_field();
		$type = $this->get_type_field();
		return $title.$type;
	}

	protected function get_type_field() {
		$name = $this->get_admin_field_name('type');
		$field = sprintf( __( 'Type: %s %s %s', 'tribe-events-filter-view' ),
			sprintf( '<label><input type="radio" name="%s" value="select" %s /> %s</label>',
				$name,
				checked( $this->type, 'select', false ),
				__( 'Dropdown', 'tribe-events-filter-view' )
			),
			sprintf( '<label><input type="radio" name="%s" value="checkbox" %s /> %s</label>',
				$name,
				checked( $this->type, 'checkbox', false ),
				__( 'Checkboxes', 'tribe-events-filter-view' )
			),
			sprintf( '<label><input type="radio" name="%s" value="autocomplete" %s /> %s</label>',
				$name,
				checked( $this->type, 'autocomplete', false ),
				__( 'Autocomplete', 'tribe-events-filter-view' )
			)
		);
		return '<div class="tribe_events_active_filter_type_options">'.$field.'</div>';
	}

	protected function get_values() {
		/** @var wpdb $wpdb */
		global $wpdb;

		// get venue IDs associated with published posts
		$venue_ids = $wpdb->get_col($wpdb->prepare("SELECT DISTINCT m.meta_value FROM {$wpdb->postmeta} m INNER JOIN {$wpdb->posts} p ON p.ID=m.post_id WHERE p.post_type=%s AND p.post_status='publish' AND m.meta_key='_EventVenueID' AND m.meta_value > 0", TribeEvents::POSTTYPE));
		$venue_ids = array_filter($venue_ids);
		if ( empty($venue_ids) ) {
			return array();
		}
		$venues = get_posts(array(
			'post_type' => TribeEvents::VENUE_POST_TYPE,
			'posts_per_page' => 200, // arbitrary limit
			'suppress_filters' => FALSE,
			'post__in' => $venue_ids,
			'post_status' => 'publish',
			'orderby' => 'title',
			'order' => 'ASC',
		));

		$venues_array = array();
		foreach( $venues as $venue ) {
			$venues_array[] = array(
				'name' => $venue->post_title,
				'value' => $venue->ID,
			);
		}

		return $venues_array;
	}

	protected function setup_join_clause() {
		global $wpdb;
		$this->joinClause = "LEFT JOIN {$wpdb->postmeta} AS venue_filter ON ({$wpdb->posts}.ID = venue_filter.post_id AND venue_filter.meta_key = '_EventVenueID')";
	}

	protected function setup_where_clause() {
		if( is_array( $this->currentValue ) )
			$venue_ids = implode(',', array_map('intval', $this->currentValue));
		else
			$venue_ids = intval( $this->currentValue );

		$this->whereClause = " AND venue_filter.meta_value IN ($venue_ids) ";
	}
}
 