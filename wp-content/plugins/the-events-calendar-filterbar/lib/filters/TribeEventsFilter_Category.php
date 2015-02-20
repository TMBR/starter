<?php

/**
 * Class TribeEventsFilter_Category
 */
class TribeEventsFilter_Category extends TribeEventsFilter {
	public $type = 'select';

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
		$terms = array();

		// Load all available event categories
		$source = get_terms( TribeEvents::TAXONOMY, array( 'orderby' => 'name', 'order' => 'ASC' ) );
		if ( empty( $source ) || is_wp_error( $source ) ) return array();

		// Preprocess the terms
		foreach ( $source as $term ) {
			$terms[ (int) $term->term_id ] = $term;
			$term->parent = (int) $term->parent;
			$term->depth = 0;
			$term->children = array();
		}

		// Initally copy the source list of terms to our ordered list
		$ordered_terms = $terms;

		// Re-order!
		foreach ( $terms as $id => $term ) {
			// Skip root elements
			if ( 0 === $term->parent ) continue;

			// Reposition child terms within the ordered terms list
			unset( $ordered_terms[$id] );
			$term->depth = $terms[$term->parent]->depth + 1;
			$terms[$term->parent]->children[$id] = $term;
		}

		// Finally flatten out and return
		return $this->flattened_term_list( $ordered_terms );
	}

	/**
	 * Flatten out the hierarchical list of event categories into a single list of values,
	 * applying formatting (non-breaking spaces) to help indicate the depth of each nested
	 * item.
	 *
	 * @param array $term_items
	 * @param array $existing_list
	 * @return array
	 */
	protected function flattened_term_list( array $term_items, array $existing_list = null ) {
		// Pull in the existing list when called recursively
		$flat_list = is_array( $existing_list ) ? $existing_list : array();

		// Add each item - including nested items - to the flattened list
		foreach ( $term_items as $term ) {
			$flat_list[] = array(
				'name'  => str_repeat( '&nbsp;', $term->depth * 2 ) . $term->name,
				'value' => $term->term_id,
				'data'  => array( 'slug' => $term->slug ),
				'class' => 'tribe-events-category-' . $term->slug
			);

			if ( ! empty( $term->children ) ) {
				$child_items = $this->flattened_term_list( $term->children, $existing_list );
				$flat_list = array_merge( $flat_list, $child_items );
			}
		}

		return $flat_list;
	}

	protected function setup_query_args() {
		$this->queryArgs = array( 'tax_query' => array( array(
			'taxonomy' => TribeEvents::TAXONOMY,
			'field' => 'id',
			'terms' => $this->currentValue,
			'include_children' => false,
		) ) );
	}

}
 