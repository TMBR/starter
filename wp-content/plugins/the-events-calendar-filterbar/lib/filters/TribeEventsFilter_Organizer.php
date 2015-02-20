<?php

/**
 * Class TribeEventsFilter_Organizer
 */
class TribeEventsFilter_Organizer extends TribeEventsFilter {
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
		// get organizer IDs associated with published posts
		$organizer_ids = $wpdb->get_col($wpdb->prepare("SELECT DISTINCT m.meta_value FROM {$wpdb->postmeta} m INNER JOIN {$wpdb->posts} p ON p.ID=m.post_id WHERE p.post_type=%s AND p.post_status='publish' AND m.meta_key='_EventOrganizerID' AND m.meta_value > 0", TribeEvents::POSTTYPE));
		array_filter($organizer_ids);
		if ( empty($organizer_ids) ) {
			return array();
		}
		$organizers = get_posts(array(
			'post_type' => TribeEvents::ORGANIZER_POST_TYPE,
			'posts_per_page' => 200, // arbitrary limit
			'suppress_filters' => FALSE,
			'post__in' => $organizer_ids,
			'post_status' => 'publish',
			'orderby' => 'title',
			'order' => 'ASC',
		));

		$organizers_array = array();
		foreach( $organizers as $organizer ) {
			$organizers_array[] = array(
				'name' => $organizer->post_title,
				'value' => $organizer->ID,
			);
		}
		return $organizers_array;
	}

	protected function setup_join_clause() {
		global $wpdb;
		$this->joinClause = "LEFT JOIN {$wpdb->postmeta} AS organizer_filter ON ({$wpdb->posts}.ID = organizer_filter.post_id AND organizer_filter.meta_key = '_EventOrganizerID')";
	}

	protected function setup_where_clause() {
		if( is_array( $this->currentValue ) )
			$organizer_ids = implode(',', array_map('intval', $this->currentValue));
		else
			$organizer_ids = intval( $this->currentValue );
		
		$this->whereClause = " AND organizer_filter.meta_value IN ($organizer_ids) ";
	}
}
 