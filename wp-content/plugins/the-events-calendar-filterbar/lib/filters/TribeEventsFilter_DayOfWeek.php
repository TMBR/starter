<?php

/**
 * Class TribeEventsFilter_DayOfWeek
 */
class TribeEventsFilter_DayOfWeek extends TribeEventsFilter {

	public $type = 'checkbox';

	protected function get_values() {
		$day_of_week_array = array(
			'1' => __( 'Sunday', 'tribe-events-filter-view' ),
			'2' => __( 'Monday', 'tribe-events-filter-view' ),
			'3' => __( 'Tuesday', 'tribe-events-filter-view' ),
			'4' => __( 'Wednesday', 'tribe-events-filter-view' ),
			'5' => __( 'Thursday', 'tribe-events-filter-view' ),
			'6' => __( 'Friday', 'tribe-events-filter-view' ),
			'7' => __( 'Saturday', 'tribe-events-filter-view' ),
		);

		$day_of_week_values = array();
		foreach ( $day_of_week_array as $value => $name ) {
			$day_of_week_values[] = array(
				'name' => $name,
				'value' => $value,
			);
		}

		return $day_of_week_values;
	}

	protected function setup_join_clause() {
		add_filter( 'posts_join', array( 'TribeEventsQuery', 'posts_join' ), 10, 2 );
	}

	protected function setup_where_clause() {
		/** @var wpdb $wpdb */
		global $wpdb;
		$clauses = array();
		$values = array_map( 'intval', $this->currentValue );
		$values = implode( ',', $values );

		$eod_cutoff = tribe_get_option( 'multiDayCutoff', '00:00' );
		if ( $eod_cutoff != '00:00' ) {
			$eod_time_difference = TribeDateUtils::timeBetween( '1/1/2014 00:00:00', "1/1/2014 {$eod_cutoff}:00" );
			$start_date = "DATE_SUB({$wpdb->postmeta}.meta_value, INTERVAL {$eod_time_difference} SECOND)";
			$end_date = "DATE_SUB(tribe_event_end_date.meta_value, INTERVAL {$eod_time_difference} SECOND)";
		} else {
			$start_date = "{$wpdb->postmeta}.meta_value";
			$end_date = "tribe_event_end_date.meta_value";
		}

		$clauses[] = "(DAYOFWEEK($start_date) IN ($values))";


		// is it on at least 7 days (first day is 0)
		$clauses[] = "(DATEDIFF($end_date, $start_date) >=6)";

		// determine if the start of the nearest matching day is between the start and end dates
		$distance_to_day = array();
		foreach ( $this->currentValue as $day_of_week_index ) {
			$day_of_week_index = (int)$day_of_week_index;
			$distance_to_day[] = "MOD( 7 + $day_of_week_index - DAYOFWEEK($start_date), 7 )";
		}
		if ( count($distance_to_day) > 1 ) {
			$distance_to_next_matching_day = "LEAST(".implode(',', $distance_to_day).")";
		} else {
			$distance_to_next_matching_day = reset($distance_to_day);
		}
		$clauses[] = "(DATE(DATE_ADD($start_date, INTERVAL $distance_to_next_matching_day DAY)) < $end_date)";

		$this->whereClause = ' AND ('.implode(' OR ', $clauses).')';
	}
}
 