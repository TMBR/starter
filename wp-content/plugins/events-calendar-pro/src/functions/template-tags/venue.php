<?php
/**
 * Events Calendar Pro Venue Template Tags
 *
 * Display functions for use in WordPress templates.
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if ( class_exists( 'Tribe__Events__Pro__Main' ) ) {

	/**
	 * Output the upcoming events associated with a venue.
	 *
	 * @param bool|int $post_id  The Venue post ID.
	 * @param array    $wp_query An array of arguments to override the default ones.
	 *
	 * @return null|string Null if the specified venue does not exist, the upcoming events
	 *                     HTML otherwise.
	 */
	function tribe_venue_upcoming_events( $post_id = false, array $args = array() ) {
		$page = ! empty( $args['page'] ) ? $args['page'] : 1;

		$post_id = Tribe__Events__Main::postIdHelper( $post_id );

		if ( $post_id ) {
			$args = array(
				'venue'          => $post_id,
				'eventDisplay'   => 'list',
				'posts_per_page' => apply_filters( 'tribe_events_single_venue_posts_per_page', 100 ),
				'paged'          => $page,
			);

			$html = tribe_include_view_list( $args );

			return apply_filters( 'tribe_venue_upcoming_events', $html );
		}

		return null;
	}

	/**
	 * Gets the URL to the previous events for a venue.
	 *
	 * @param int $page        The current page number
	 * @param int $venue_id    The current venue post ID; will be read from the global `post` object
	 *                         if missing.
	 *
	 * @return string The absolute ugly URL to the previous events for the venue.
	 */
	function tribe_venue_previous_events_link( $page, $venue_id = null ) {
		return tribe_venue_direction_link( $page, $venue_id, 'prev' );
	}

	/**
	 * Gets the URL to the next events for a venue.
	 *
	 * @param int $page        The current page number
	 * @param int $venue_id    The current venue post ID; will be read from the global `post` object
	 *                         if missing.
	 *
	 * @return string The absolute ugly URL to the next events for the venue.
	 */
	function tribe_venue_next_events_link( $page, $venue_id = null ) {
		return tribe_venue_direction_link( $page, $venue_id, 'next' );
	}

	/**
	 * Checks whether a venue has more events in respect to the current page.
	 *
	 * @param     int $page     The current page number.
	 * @param int     $venue_id The current venue post ID; will be read from the global `post` object
	 *                          if missing.
	 *
	 * @return bool `false` if there are no next events, the post is not a venue or the page number is
	 *              not an int value, `true` if there are next events.
	 */
	function tribe_venue_has_next_events( $page, $venue_id = null ) {
		if ( ! is_numeric( $page ) && is_int( $page ) ) {
			return false;
		}

		$post_id = Tribe__Main::post_id_helper( $venue_id );
		if ( ! tribe_is_venue( $post_id ) ) {
			return false;
		}

		$args = array(
			'venue'          => $venue_id,
			'page'           => $page + 1,
			'posts_per_page' => apply_filters( 'tribe_events_single_venue_posts_per_page', 100 ),
		);

		$events = tribe_get_events( $args );

		return ! empty( $events );
	}

	/**
	 * Gets the URL to the next or previous events for a venue.
	 *
	 * @param int    $page     The current page number
	 * @param int    $venue_id The current venue post ID; will be read from the global `post` object
	 *                         if missing.
	 * @param string $direction Either 'next' or 'prev'.
	 *
	 * @return string The absolute ugly URL to the next/previous events for the venue.
	 */
	function tribe_venue_direction_link( $page, $venue_id, $direction = 'next' ) {
		if ( ! in_array( $direction, array( 'next', 'prev' ) ) ) {
			return '';
		}

		if ( ! ( is_numeric( $page ) && is_int( $page ) ) ) {
			return '';
		}

		if ( $direction === 'prev' && $page < 2 ) {
			return '';
		}

		$post_id = Tribe__Main::post_id_helper( $venue_id );
		if ( ! tribe_is_venue( $post_id ) ) {
			return '';
		}

		$name = get_post( $venue_id )->post_name;

		$page = $direction === 'next' ? $page + 1 : $page - 1;

		return add_query_arg( array( Tribe__Events__Venue::POSTTYPE => $name, 'page' => $page ), home_url() );
	}
}
