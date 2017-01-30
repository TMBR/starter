<?php


class Tribe__Events__Pro__Templates__Mods__List_View {

	public static function print_all_events_link() {
		// Only add this link if we are viewing all instances of a recurring event (ie, '/event/some-slug/all/')
		if ( 'all' !== $GLOBALS['wp_query']->get( 'eventDisplay' ) ) {
			return;
		}

		if ( tribe_is_recurring_event() ) {
			?>
			<p class="tribe-events-back tribe-events-loop">
				<a href="<?php echo esc_url( tribe_get_events_link() ); ?>">
					<?php printf( '&laquo; ' . esc_html__( 'All %s', 'the-events-calendar' ), tribe_get_event_label_plural() ); ?>
				</a>
			</p>
			<?php
		}
	}
}