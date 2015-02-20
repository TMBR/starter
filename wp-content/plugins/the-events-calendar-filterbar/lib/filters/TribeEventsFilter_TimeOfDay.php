<?php

/**
 * Class TribeEventsFilter_TimeOfDay
 */
class TribeEventsFilter_TimeOfDay extends TribeEventsFilter {
	public $type = 'checkbox';

	protected function get_values() {
		// The time-of-day filter.
		$time_of_day_array = array(
			'allday' => __( 'All Day', 'tribe-events-filter-view' ),
			'06-12' => __( 'Morning', 'tribe-events-filter-view' ),
			'12-17' => __( 'Afternoon', 'tribe-events-filter-view' ),
			'17-21' => __( 'Evening', 'tribe-events-filter-view' ),
			'21-06' => __( 'Night', 'tribe-events-filter-view' ),
		);

		$time_of_day_values = array();
		foreach( $time_of_day_array as $value => $name ) {
			$time_of_day_values[] = array(
				'name' => $name,
				'value' => $value,
			);
		}
		return $time_of_day_values;
	}

	protected function setup_join_clause() {
		add_filter( 'posts_join', array( 'TribeEventsQuery', 'posts_join' ), 10, 2 );
		global $wpdb;
		$values = $this->currentValue;

		$all_day_index = array_search( 'allday', $values );
		if ( $all_day_index !== FALSE ) unset($values[$all_day_index]);
		$this->joinClause .= " LEFT JOIN {$wpdb->postmeta} AS all_day ON ({$wpdb->posts}.ID = all_day.post_id AND all_day.meta_key = '_EventAllDay')";

		if ( !empty($values) ) { // values other than allday
			$this->joinClause .= " INNER JOIN {$wpdb->postmeta} AS tod_start_date ON ({$wpdb->posts}.ID = tod_start_date.post_id AND tod_start_date.meta_key = '_EventStartDate')";
			$this->joinClause .= " INNER JOIN {$wpdb->postmeta} AS tod_duration ON ({$wpdb->posts}.ID = tod_duration.post_id AND tod_duration.meta_key = '_EventDuration')";
		}
	}

	protected function setup_where_clause() {
		global $wpdb;
		$clauses = array();

		if ( in_array( 'allday', $this->currentValue ) ) $clauses[] = "(all_day.meta_value = 'yes')";
		else $this->whereClause = ' AND ( all_day.meta_id IS NULL ) ';

		foreach ( $this->currentValue as $value ) {
			if ( $value == 'allday' ) {
				continue; // handled earlier
			}
			$value = explode( '-', $value );
			$abs[0] = $value[0];
			$abs[1] = $value[1];
			$value[0] = $value[0] . ':00:00';
			$value[1] = $value[1] . ':00:00';
			// If it spans the day marker...
			if ( $abs[0] > $abs[1] ) {
				$start_measure_date = new DateTime( '2011-01-01 ' . $value[0] );
				$end_measure_date = new DateTime( '2011-01-02 ' . $value[1] );
				$interval = date( $end_measure_date->format('U') - $start_measure_date->format('U') );
				$clauses[] = $wpdb->prepare( "
				(
					   ( TIME(CAST(tod_start_date.meta_value as DATETIME)) < %s )
					OR ( TIME(CAST(tod_start_date.meta_value as DATETIME)) > %s )
					OR ( MOD(TIME_TO_SEC(TIMEDIFF(%s, TIME(CAST(tod_start_date.meta_value as DATETIME)))) + 86400, 86400) < tod_duration.meta_value )
				)", $value[1], $value[0], $value[1], $value[0], $interval );
			} else {
				$clauses[] = $wpdb->prepare( "
				(
					   ( TIME(CAST(tod_start_date.meta_value as DATETIME)) >= %s AND TIME(CAST(tod_start_date.meta_value as DATETIME)) < %s )
					OR ( MOD(TIME_TO_SEC(TIMEDIFF(%s, TIME(CAST(tod_start_date.meta_value as DATETIME)))) + 86400, 86400) < tod_duration.meta_value )
				)", $value[0], $value[1], $value[0] );
			}
		}
		$this->whereClause .= ' AND ('.implode(' OR ', $clauses).')';
	}
}
 