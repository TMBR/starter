<?php

/**
 * Class TribeEventsFilter_Cost
 */
class TribeEventsFilter_Cost extends TribeEventsFilter {
	const EXPLICITLY_FREE = 'set_to_0';
	const IMPLICITLY_FREE = 'unset_or_0';

	public $type = 'range';
	public $free = self::IMPLICITLY_FREE;
	private $min_cost = NULL;
	private $max_cost = NULL;


	protected function settings() {
		parent::settings();
		$this->free_logic();
	}

	protected function free_logic() {
		$settings = TribeEventsFilterView::instance()->get_filter_settings();
		$this->free = isset( $settings[$this->slug]['free'] ) && self::EXPLICITLY_FREE === $settings[$this->slug]['free']
			? self::EXPLICITLY_FREE : self::IMPLICITLY_FREE;
	}

	protected function get_submitted_value() {
		if ( isset( $_REQUEST['tribe_' . $this->slug] ) ) {
			$value = $_REQUEST['tribe_' . $this->slug];
			if ( !is_array($value) ) {
				$value = array($value);
			}
			if ( isset($value['min']) && isset($value['max']) ) {
				return array($value);
			} else {
				foreach ( $value as &$v ) {
					$range = explode('-', $v);
					$v = array('min' => $range[0], 'max' => $range[1]);
				}
				return $value;
			}
		}
		return array();
	}

	public function get_admin_form() {
		$title = $this->get_title_field();
		$type = $this->get_type_field();
		return $title.$type;
	}

	protected function get_type_field() {
		$name = $this->get_admin_field_name('type');
		$type_field = sprintf( __( 'Type: %s %s', 'tribe-events-filter-view' ),
			sprintf( '<label><input type="radio" name="%s" value="range" %s /> %s</label>',
				$name,
				checked( $this->type, 'range', false ),
				__( 'Range Slider', 'tribe-events-filter-view' )
			),
			sprintf( '<label><input type="radio" name="%s" value="checkbox" %s /> %s</label>',
				$name,
				checked( $this->type, 'checkbox', false ),
				__( 'Checkboxes', 'tribe-events-filter-view' )
			)
		);

		$name = $this->get_admin_field_name('free');
		$cost_field = sprintf( __( 'Events are considered free when cost field is: %s %s', 'tribe-events-filter-view' ),
			sprintf( '<label><input type="radio" name="%s" value="unset_or_0" %s /> %s</label>',
				$name,
				checked( $this->free, 'unset_or_0', false ),
				__( 'Empty or set to zero', 'tribe-events-filter-view' )
			),
			sprintf( '<label><input type="radio" name="%s" value="set_to_0" %s /> %s</label>',
				$name,
				checked( $this->free, 'set_to_0', false ),
				__( 'Only when set to zero', 'tribe-events-filter-view' )
			)
		);

		return '<div class="tribe_events_active_filter_type_options">' . $type_field . $cost_field . '</div>';
	}

	protected function get_values() {
		$this->set_min_and_max();

		if ( $this->type == 'range' ) {
			return array( 'min' => $this->min_cost, 'max' => $this->max_cost );
		}

		$cost_range = array();
		if ( $this->min_cost == 0 ) {
			$cost_range['0-0'] =  __('Free', 'tribe-events-filter-view');
		}
		if ( $this->max_cost == $this->min_cost ) {
			if ( $this->max_cost != 0 ) {
				$cost_range[$this->min_cost . '-' . $this->max_cost] = $this->min_cost . '-' . $this->max_cost;
			}
		} else { // break the range into five equal groups
			$cost_chunks = $this->partition_range(floor($this->min_cost), floor($this->max_cost), (5-count($cost_range)));
			foreach ( $cost_chunks as &$chunk ) {
				$cost_range[$chunk['min'].'-'.$chunk['max']] = $chunk['min'].'-'.$chunk['max'];
			}
		}
		$values = array();
		foreach ( $cost_range as $key => $cost ) {
			$values[] = array(
				'name' => $cost,
				'value' => $key,
			);
		}
		return $values;
	}

	private function partition_range( $min, $max, $count ) {
		$range_size = $max - $min + 1;
		$partition_size = floor( $range_size / $count );
		$partition_remainder = $range_size % $count;
		$partitioned = array();
		$mark = $min;
		for ($i = 0; $i < $count; $i++) {
			$incr = ($i < $partition_remainder) ? $partition_size : $partition_size - 1;
			$partitioned[$i] = array(
				'min' => $mark,
				'max' => $mark + $incr,
			);
			$mark += $incr + 1;
		}
		return $partitioned;
	}

	protected function is_selected( $option ){
		if ( is_string($option) ) {
			$option = explode('-', $option);
			$option = array('min' => $option[0], 'max' => $option[1]);
		}
		return in_array($option, $this->currentValue);
	}

	protected function setup_query_filters() {
		if ( $this->currentValue ) {
			$this->set_min_and_max();
		}
		parent::setup_query_filters();
	}

	protected function setup_join_clause() {
		global $wpdb;
		$this->joinClause = " LEFT JOIN {$wpdb->postmeta} AS cost_filter ON ({$wpdb->posts}.ID = cost_filter.post_id)";
	}

	protected function setup_where_clause() {
		global $wpdb;
		$clauses = array();

		foreach ( $this->currentValue as $value ) {
			// Should we exclude events where a cost has not been provided?
			$free_clause = $this->free_clause( $value['min'] );

			if ( $value['min'] == 0 && $value['max'] == 0 ) {
				$clauses[] = "(cost_filter.meta_key = '_EventCost' $free_clause AND (cost_filter.meta_value = 0 OR cost_filter.meta_value = '' OR cost_filter.meta_value IS NULL) )";
			}
			else {
				$clauses[] = $wpdb->prepare("(cost_filter.meta_key = '_EventCost' $free_clause AND cost_filter.meta_value >= %d AND cost_filter.meta_value IS NOT NULL AND CAST(cost_filter.meta_value AS SIGNED) BETWEEN %d AND %d) ", $value['min'], $value['min'], $value['max']);
			}
		}
		$this->whereClause = ' AND ('.implode(' OR ', $clauses).') ';
	}

	protected function free_clause( $min ) {
		return self::EXPLICITLY_FREE === $this->free && 0 === (int) $min
			? 'AND LENGTH( TRIM( cost_filter.meta_value ) ) > 0'
			: '';
	}

	private function set_min_and_max() {
		if ( !isset($this->max_cost) || !isset($this->min_cost) ) {
			$this->max_cost = tribe_get_maximum_cost();
			$this->min_cost = tribe_get_minimum_cost();
		}
	}
}
 