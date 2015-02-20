<?php

/**
 * Class TribeEventsFilter_Tag
 */
class TribeEventsFilter_Tag extends TribeEventsFilter{
	public $type = 'checkbox';

	public function get_admin_form() {
		$title = $this->get_title_field();
		$type = $this->get_type_field();
		return $title.$type;
	}

	protected function get_values() {
		$tags_array = array();

		$tags = get_tags();
		foreach( $tags as $tag ) {
			$tags_array[$tag->term_id] = array(
				'name' => $tag->name,
				'value' => $tag->term_id,
			);
		}

		return $tags_array;
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

	protected function setup_query_args() {
		$this->queryArgs = array( 'tag__in' => $this->currentValue );
	}
}
 