<?php
/**
 * Filter View Template
 * This contains the hooks to generate a filter sidebar.
 *
 * @package TribeEventsCalendar
 * @since  1.0
 * @author Modern Tribe Inc.
 *
 */

// Don't load directly
if ( !defined('ABSPATH') ) { die('-1'); } ?>

<?php do_action( 'tribe_events_filter_view_before_template' ); ?>

	<div id="tribe_events_filters_wrapper" class="tribe-events-filters-vertical tribe-clearfix">
		<?php do_action( 'tribe_events_filter_view_before_filters' ); ?>
		<div id="tribe_events_filter_control">
			<a id="tribe_events_filters_toggle" class="tribe_events_filters_close_filters" href="#" data-state="<?php _e( 'Show Advanced Filters', 'tribe-events-filter-view' ); ?>"><?php _e( 'Collapse Filters', 'tribe-events-filter-view' ); ?></a>
			<a id="tribe_events_filters_toggle" class="tribe_events_filters_show_filters" href="#" ><?php _e( 'Show Filters', 'tribe-events-filter-view' ); ?></a>
		</div>
		<div class="tribe-events-filters-content tribe-clearfix">
			<label class="tribe-events-filters-label"><?php _e(  'Narrow Your Results', 'tribe-events-filter-view' ); ?></label>

			<form id="tribe_events_filters_form" method="post" action="">

				<?php do_action( 'tribe_events_filter_view_do_display_filters' ); ?>

				<input type="submit" value="<?php _e( 'Submit' ) ?>" />

				<a id="tribe_events_filters_reset" href="#"><?php _e( 'Reset Filters', 'tribe-events-filter-view' ); ?></a>
			</form>
			<div id="tribe_events_filter_control" class="tribe-events-filters-mobile-controls tribe-clearfix">
				<a id="tribe_events_filters_toggle" class="tribe_events_filters_close_filters" href="#" ><?php _e( 'Collapse Filters', 'tribe-events-filter-view' ); ?></a>
				<a id="tribe_events_filters_reset" href="#"><?php _e( 'Reset Filters', 'tribe-events-filter-view' ); ?></a>
			</div>
		</div>

		<?php do_action( 'tribe_events_filter_view_after_filters' ); ?>

	</div>

<?php do_action( 'tribe_events_filter_view_after_template' ); ?>

