<?php
$months = array();
for ( $i = 1; $i <= 12; $i++ ) {
	$months[] = array(
		'id' => $i,
		'text' => date_i18n( 'F', mktime( 12, 0, 0, $i, 1, 2020 ) ),
	);
}
?>
<div class="tribe-month-select">
	<span class="tribe-dependent" data-depends="#<?php echo esc_attr( $rule_prefix ); ?>_rule_--_type" data-condition="Yearly">
		<span class="tribe-field-inline-text"><?php esc_html_e( 'Every', 'tribe-events-calendar-pro' ); ?></span>
		<input
			type="text"
			id="<?php echo esc_attr( $rule_prefix ); ?>_rule_--_interval_year"
			name="recurrence[<?php echo esc_attr( $rule_type ); ?>][][custom][interval]"
			class="tribe-dropdown tribe-recurrence-rule-interval"
			data-options="<?php echo esc_attr( json_encode( $interval_options ) ); ?>"
			data-freeform
			data-int
			data-field="custom-interval"
			value="{{#if custom.interval}}{{custom.interval}}{{else}}1{{/if}}"
			style="display:inline-block;"
		/>
		<span class="tribe-field-inline-text tribe-field-inline-last tribe-dependent" data-depends="#<?php echo esc_attr( $rule_prefix ); ?>_rule_--_type" data-condition="Yearly">
			<span class="tribe-dependent" data-depends="#<?php echo esc_attr( $rule_prefix ); ?>_rule_--_interval" data-condition="1">
				<?php esc_html_e( 'year', 'tribe-events-calendar-pro' ); ?>
			</span>
			<span class="tribe-dependent" data-depends="#<?php echo esc_attr( $rule_prefix ); ?>_rule_--_interval" data-condition-not="1">
				<?php esc_html_e( 'years', 'tribe-events-calendar-pro' ); ?>
			</span>
		</span>
	</span>

	<span class="month-label">
		<span class="tribe-field-inline-text tribe-field-inline-first"><?php echo esc_html_x( 'in', 'Begins the line indicating on which month the event will occur', 'tribe-events-calendar-pro' ); ?></span>
		<h3 id="month-the-event-will-recur-in" class="screen-reader-text"><?php esc_html_e( 'Which month will the event recur in?', 'tribe-events-calendar-pro' ); ?></h3>
	</span>
	<input
		name="recurrence[<?php echo esc_attr( $rule_type ); ?>][][custom][year][month]"
		id="<?php echo esc_attr( $rule_prefix ); ?>_rule_--_year_month"
		class="custom-recurrence-years tribe-dropdown tribe-dependency"
		data-hide-search
		data-field="custom-year-month"
		multiple
		data-options="<?php echo esc_attr( json_encode( $months ) ); ?>"
		data-depends="#<?php echo esc_attr( $rule_prefix ); ?>_rule_--_custom_year_month"
		value="{{ custom.year.month }}"
	>
</div>
<div class="tribe-dame-day-select">
	<span class="tribe-field-inline-text first-label-in-line">
		<?php esc_html_e( 'On', 'tribe-events-calendar-pro' ); ?>
	</span>
	<select
		name="recurrence[rules][][custom][year][filter]"
		id="<?php echo esc_attr( $rule_prefix ); ?>_rule_--_year_same_day"
		class="tribe-dropdown tribe-same-day-select"
		data-hide-search
		data-field="year-same-day"
	>
		{{#tribe_recurrence_select custom.year.filter}}
		<option value="0"><?php esc_html_e( 'the same day', 'tribe-events-calendar-pro' ); ?></option>
		<option value="1"><?php esc_html_e( 'a different day:', 'tribe-events-calendar-pro' ); ?></option>
		{{/tribe_recurrence_select}}
	</select>
	<span
		class="tribe-field-inline-text recurrence-same-day-text tribe-dependent"
		data-depends="#<?php echo esc_attr( $rule_prefix ); ?>_rule_--_year_same_day"
		data-condition-not="1"
	></span>
	<span
		class="tribe-dependent"
		data-depends="#<?php echo esc_attr( $rule_prefix ); ?>_rule_--_year_same_day"
		data-condition="1"
	>
			<span
				class="tribe-field-inline-text tribe-dependent"
				data-depends="#<?php echo esc_attr( $rule_prefix ); ?>_rule_--_year_number"
				data-condition-is-numeric
			>
				<?php echo esc_html_x( 'day', 'Qualifying the "different day". Example: "day" in "day 12 of the month"', 'tribe-events-calendar-pro' ); ?>
			</span>
			<span
				class="tribe-field-inline-text tribe-dependent"
				data-depends="#<?php echo esc_attr( $rule_prefix ); ?>_rule_--_year_number"
				data-condition-is-not-numeric
			>
				<?php echo esc_html_x( 'the', 'Qualifying the "different day". Example: "the" in "the first Friday"', 'tribe-events-calendar-pro' ); ?>
			</span>
			<select
				name="recurrence[<?php echo esc_attr( $rule_type ); ?>][][custom][year][number]"
				id="<?php echo esc_attr( $rule_prefix ); ?>_rule_--_year_number"
				class="tribe-dropdown"
				data-field="custom-year-month-number"
				data-hide-search
				data-prevent-clear
			>
				{{#tribe_recurrence_select custom.year.number}}
					<optgroup label="<?php esc_attr_e( 'Use pattern:', 'tribe-events-calendar-pro' ); ?>">
						<option value="First"><?php esc_html_e( 'first', 'tribe-events-calendar-pro' ); ?></option>
						<option value="Second"><?php esc_html_e( 'second', 'tribe-events-calendar-pro' ); ?></option>
						<option value="Third"><?php esc_html_e( 'third', 'tribe-events-calendar-pro' ); ?></option>
						<option value="Fourth"><?php esc_html_e( 'fourth', 'tribe-events-calendar-pro' ); ?></option>
						<option value="Fifth"><?php esc_html_e( 'fifth', 'tribe-events-calendar-pro' ); ?></option>
						<option value="Last"><?php esc_html_e( 'last', 'tribe-events-calendar-pro' ); ?></option>
					</optgroup>
					<optgroup label="<?php esc_attr_e( 'Use date:', 'tribe-events-calendar-pro' ); ?>">
						<?php for ( $i = 1; $i <= 31; $i ++ ): ?>
							<option value="<?php echo $i ?>"><?php echo $i; ?></option>
						<?php endfor; ?>
					</optgroup>
				{{/tribe_recurrence_select}}
			</select>
			<span
				class="tribe-dependent"
				data-depends="#<?php echo esc_attr( $rule_prefix ); ?>_rule_--_year_number"
				data-condition-is-not-numeric
			>
				<select
					name="recurrence[<?php echo esc_attr( $rule_type ); ?>][][custom][year][day]"
					class="tribe-dropdown"
					data-field="custom-year-month-day"
					data-hide-search
					data-prevent-clear
				>
					{{#tribe_recurrence_select custom.year.day}}
						<option value="1"><?php esc_html_e( 'Monday', 'tribe-events-calendar-pro' ); ?></option>
						<option value="2"><?php esc_html_e( 'Tuesday', 'tribe-events-calendar-pro' ); ?></option>
						<option value="3"><?php esc_html_e( 'Wednesday', 'tribe-events-calendar-pro' ); ?></option>
						<option value="4"><?php esc_html_e( 'Thursday', 'tribe-events-calendar-pro' ); ?></option>
						<option value="5"><?php esc_html_e( 'Friday', 'tribe-events-calendar-pro' ); ?></option>
						<option value="6"><?php esc_html_e( 'Saturday', 'tribe-events-calendar-pro' ); ?></option>
						<option value="7"><?php esc_html_e( 'Sunday', 'tribe-events-calendar-pro' ); ?></option>
						<option value="-">--</option>
						<option value="8"><?php esc_html_e( 'day', 'tribe-events-calendar-pro' ); ?></option>
					{{/tribe_recurrence_select}}
				</select>
			</span>
			<span
				class="tribe-dependent tribe-field-inline-text"
				data-depends="#<?php echo esc_attr( $rule_prefix ); ?>_rule_--_year_number"
				data-condition-is-numeric
			>
				<?php echo esc_html_x( 'of the month', 'As in: day 12 of the month', 'tribe-events-calendar-pro' ); ?>
			</span>
		</span>
</div>
</select>
