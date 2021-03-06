<?php

/**
 * Class Tribe__Events__Pro__Recurrence__Permalinks
 */
class Tribe__Events__Pro__Recurrence__Permalinks {

	public function filter_recurring_event_permalinks( $post_link, $post, $leavename, $sample ) {
		if ( ! $this->should_filter_permalink( $post, $sample ) ) {
			return $post_link;
		}

		// URL Arguments on home_url() pre-check
		$url_query = @parse_url( $post_link, PHP_URL_QUERY );
		$url_args = wp_parse_args( $url_query, array() );
		$permalink_structure = get_option( 'permalink_structure' );

		// Remove the "args"
		if ( ! empty( $url_query ) && '' !== $permalink_structure ) {
			$post_link = str_replace( '?' . $url_query, '', $post_link );
		}

		$permastruct = $this->get_permastruct( $post );
		if ( $leavename && empty( $post->post_parent ) ) {
			$date = 'all'; // sample permalink for the series
		} else {
			$date = $this->get_date_string( $post );
		}
		$parent = $this->get_primary_event( $post );
		$slug   = $parent->post_name;

		if ( '' === $permalink_structure ) {
			$post_link = remove_query_arg( Tribe__Events__Main::POSTTYPE, $post_link );
			$post_link = add_query_arg( array(
				Tribe__Events__Main::POSTTYPE => $slug,
				'eventDate'           => $date,
			), $post_link );
		} elseif ( ! empty( $permastruct ) ) {
			if ( ! $leavename ) {
				$post_link = str_replace( "%$post->post_type%", $slug, $permastruct );
			}
			$post_link = trailingslashit( $post_link ) . $date;
			$sequence_number = get_post_meta( $post->ID, '_EventSequence', true );
			if ( !empty($sequence_number) && (is_numeric($sequence_number) && intval($sequence_number) > 1) ) {
				$post_link = trailingslashit($post_link) . $sequence_number;
			}
			$post_link = str_replace( array( home_url( '/' ), site_url( '/' ) ), '', $post_link );
			$post_link = home_url( user_trailingslashit( $post_link ) );
		}

		// Add the Arguments back
		$post_link = add_query_arg( $url_args, $post_link );

		return $post_link;
	}

	protected function should_filter_permalink( $post, $sample ) {
		if ( $post->post_type != Tribe__Events__Main::POSTTYPE ) {
			return false;
		}

		if ( ! tribe_is_recurring_event( $post->ID ) ) {
			return false;
		}

		$unpublished = isset( $post->post_status ) && in_array( $post->post_status, array(
					'draft',
					'pending',
					'auto-draft',
				) );

		if ( $unpublished && ! $sample ) {
			return false;
		}

		return true;
	}

	protected function get_date_string( $post ) {
		$date = get_post_meta( $post->ID, '_EventStartDate', true );
		$date = date( 'Y-m-d', strtotime( $date ) );

		return $date;
	}

	protected function get_primary_event( $post ) {
		while ( ! empty( $post->post_parent ) ) {
			$post = get_post( $post->post_parent );
		}

		return $post;
	}

	protected function get_permastruct( $post ) {
		global $wp_rewrite;
		$permastruct = $wp_rewrite->get_extra_permastruct( $post->post_type );

		return $permastruct;
	}

	/**
	 * Filters the sample permalink to show a link to the first instance of recurring events.
	 *
	 * This is to match the real link pointing to a recurring events series first instance.
	 *
	 * @param string  $permalink Sample permalink.
	 * @param int     $post_id   Post ID.
	 *
	 * @return string The permalink to the first recurring event instance if the the event
	 *                is a recurring one, the original permalink otherwise.
	 */
	public function filter_sample_permalink( $permalink, $post_id ) {
		if ( ! empty( $post_id ) && tribe_is_recurring_event( $post_id ) ) {
			// fetch the real post permalink, recurring event filters down the road will
			// append the date to it
			$permalink = get_post_permalink( $post_id );
		}

		return $permalink;
	}

	/**
	 * Filters the sample permalink html to show a link to the first instance of recurring events.
	 * This filter runs on private recurring events to fix a broken link that was being created in get_sample_permalink_html()
	 *
	 * This is to match the real link pointing to a recurring events series first instance.
	 *
	 * @param string $permalink_html Sample permalink html.
	 * @param int    $post_id        Post ID.
	 *
	 * @return string The label and permalink html to the first recurring event instance if the the event
	 *                is a recurring one, the original permalink otherwise.
	 */
	public function filter_sample_permalink_html( $permalink_html, $post_id ) {

		if ( ! empty( $post_id ) && 'private' == get_post_status( $post_id ) && tribe_is_recurring_event( $post_id ) ) {

			//Break up the html to remove the broken link from the label
			$permalink_html = explode( '</strong>', $permalink_html, 2 );

			//set html as label
			$permalink_html = isset( $permalink_html[0] ) ? $permalink_html[0] : '';

			// fetch the real post permalink, recurring event filters down the road will
			// append the date to it
			$url = get_post_permalink( $post_id );

			//rebuild the link
			$permalink_html = $permalink_html . sprintf( ' <a id="sample-permalink" href="%1s">%2s</a>', $url, $url );

		}

		return $permalink_html;
	}
}

