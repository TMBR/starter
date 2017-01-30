<?php
/**
 * Facilitates the copying of post meta data from one post to another,
 * specifically to facilitate recurring event generation.
 */
class Tribe__Events__Pro__Post_Meta_Copier {
	protected $original_id;
	protected $destination_id;
	protected $meta_keys = array();

	/**
	 * @param int $original_post
	 * @param int $destination_post
	 *
	 * @return void
	 */
	public function copy_meta( $original_post, $destination_post ) {
		$this->original_id    = $original_post;
		$this->destination_id = $destination_post;
		$this->clear_destination_meta();

		$post_meta_keys = get_post_custom_keys( $original_post );
		if ( empty( $post_meta_keys ) ) {
			return;
		}

		$meta_blacklist  = $this->get_meta_key_blacklist();
		$this->meta_keys = array_diff( $post_meta_keys, $meta_blacklist );

		foreach ( $this->meta_keys as $meta_key ) {
			$meta_values = get_post_custom_values( $meta_key, $original_post );
			foreach ( $meta_values as $meta_value ) {
				$meta_value = maybe_unserialize( $meta_value );
				add_post_meta( $destination_post, $meta_key, $meta_value );
			}
		}
	}

	private function clear_destination_meta() {
		$post_meta_keys = get_post_custom_keys( $this->destination_id );
		$blacklist      = $this->get_meta_key_blacklist();
		$post_meta_keys = array_diff( $post_meta_keys, $blacklist );
		foreach ( $post_meta_keys as $key ) {
			delete_post_meta( $this->destination_id, $key );
		}
	}

	private function get_meta_key_blacklist() {
		$list = array(
			'_edit_lock',
			'_edit_last',
			'_EventStartDate',
			'_EventEndDate',
			'_EventStartDateUTC',
			'_EventEndDateUTC',
			'_EventDuration',
			'_EventSequence',
		);

		// Compare the start and end times of the parent (original post) and child (destination post)
		$parent_start_time = tribe_get_start_date( $this->original_id, false, Tribe__Date_Utils::DBTIMEFORMAT );
		$parent_end_time = tribe_get_end_date( $this->original_id, false, Tribe__Date_Utils::DBTIMEFORMAT );

		$child_start_time = tribe_get_start_date( $this->destination_id, false, Tribe__Date_Utils::DBTIMEFORMAT );
		$child_end_time = tribe_get_end_date( $this->destination_id, false, Tribe__Date_Utils::DBTIMEFORMAT );

		// If the parent/child start/end times do not match then let's blacklist '_EventAllDay' to avoid marking
		// child events with a distinct start/end time of their own as being all day events
		if (
			$parent_start_time !== $child_start_time
			|| $parent_end_time !== $child_end_time
		) {
			$list[] = '_EventAllDay';
		}

		/**
		 * Allows filtering the list of meta keys that should be copied over to children events.
		 *
		 * @deprecated 4.2.2
		 *
		 * @param array $list A list of meta keys that should be copied to the child events.
		 */
		$list = apply_filters( 'tribe_events_meta_copier_blacklist', $list );

		/**
		 * Allows filtering the list of meta keys that should be copied over to children events.
		 *
		 * @todo review location and usage of this hook
		 *       - hook name suggests it is a whitelist
		 *       - actual usage of the resulting array is as a blacklist
		 *
		 * @param array $list A list of meta keys that should be copied to the child events.
		 */
		return apply_filters( 'tribe_events_meta_copier_whitelist', $list );
	}
}

