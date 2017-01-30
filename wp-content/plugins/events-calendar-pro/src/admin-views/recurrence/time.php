<?php
$start_timepicker_step = tribe( 'tec.admin.event-meta-box' )->get_timepicker_step( 'start' );
$end_timepicker_step = tribe( 'tec.admin.event-meta-box' )->get_timepicker_step( 'end' );
$timepicker_round = tribe( 'tec.admin.event-meta-box' )->get_timepicker_round();
$day_options = array();
for ( $i = 0; $i <= 7; $i++ ) {
	$last_digit = (int) substr( $i, -1 );

	if ( 0 === $i ) {
		$text = __( 'same day', 'tribe-events-calendar-pro' );
	} elseif ( 1 === $i ) {
		$text = __( 'next day', 'tribe-events-calendar-pro' );
	} elseif ( 1 === $last_digit ) {
		$text = sprintf(
			_x( '%1$sst day', 'number suffix for numbers ending in 1', 'tribe-events-calendar-pro' ),
			$i
		);
	} elseif ( 2 === $last_digit ) {
		$text = sprintf(
			_x( '%1$snd day', 'number suffix for numbers ending in 2', 'tribe-events-calendar-pro' ),
			$i
		);
	} elseif ( 3 === $last_digit ) {
		$text = sprintf(
			_x( '%1$srd day', 'number suffix for numbers ending in 3', 'tribe-events-calendar-pro' ),
			$i
		);
	} else {
		$text = sprintf(
			_x( '%1$sth day', 'number suffix for numbers ending in something other than 1, 2, or 3', 'tribe-events-calendar-pro' ),
			$i
		);
	}

	$day_options[] = array( 'id' => $i, 'text' => $text );
}

$admin_box = tribe( 'tec.admin.event-meta-box' );
$default_start_time = $admin_box->get_timepicker_default( 'start' );
$default_end_time = $admin_box->get_timepicker_default( 'end' );
?>
<div class="recurrence-time">
	<input
		autocomplete="off"
		tabindex="<?php tribe_events_tab_index(); ?>"
		type="text"
		class="tribe-timepicker tribe-field-start_time"
		name="recurrence[<?php echo esc_attr( $rule_type ); ?>][][custom][start-time]"
		id="recurrence_rule_--_same_time_start"
		<?php echo Tribe__View_Helpers::is_24hr_format() ? 'data-format="H:i"' : '' ?>
		data-step="<?php echo esc_attr( $start_timepicker_step ); ?>"
		data-round="<?php echo esc_attr( $timepicker_round ); ?>"
		data-field="custom-start-time"
		value="{{#if custom.[start-time]}}{{custom.[start-time]}}{{else}}<?php echo esc_attr( $default_start_time ); ?>{{/if}}"
	/>
	<span class="tribe-field-inline-text eventduration-preamble">
		<?php echo esc_html_x( 'to', 'custom recurrence time separator', 'tribe-events-calendar-pro' ); ?>
	</span>
	<input
		autocomplete="off"
		tabindex="<?php tribe_events_tab_index(); ?>"
		type="text"
		class="tribe-timepicker tribe-field-end_time"
		name="recurrence[<?php echo esc_attr( $rule_type ); ?>][][custom][end-time]"
		id="recurrence_rule_--_same_time_end"
		<?php echo Tribe__View_Helpers::is_24hr_format() ? 'data-format="H:i"' : '' ?>
		data-step="<?php echo esc_attr( $end_timepicker_step ); ?>"
		data-round="<?php echo esc_attr( $timepicker_round ); ?>"
		data-field="custom-end-time"
		value="{{#if custom.[end-time]}}{{custom.[end-time]}}{{else}}<?php echo esc_attr( $default_end_time ); ?>{{/if}}"
	/>
	<span class="tribe-field-inline-text">
		<?php echo esc_html_x( 'the', 'custom recurrence time/date separator', 'tribe-events-calendar-pro' ); ?>
	</span>
	<input
		type="text"
		id="recurrence_rule_--_same_time_day"
		name="recurrence[rules][][custom][end-day]"
		class="tribe-dropdown"
		data-options="<?php echo esc_attr( json_encode( $day_options ) ); ?>"
		data-int
		data-hide-search
		data-field="custom-end-day"
		value="{{#if custom.[end-day]}}{{custom.[end-day]}}{{else}}<?php esc_attr_e( 'same day', 'tribe-events-calendar-pro' ); ?>{{/if}}"
		style="display:inline-block;"
	/>
</div>
