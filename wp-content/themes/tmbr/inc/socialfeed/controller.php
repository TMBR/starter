<?php

namespace SocialFeed;

class Controller {
	static $i = null;
	public static function i()
	{
		if ( is_null( self::$i ) )
		{
			self::$i = new Controller;
		}
		return self::$i;
	}

	public static function log( $message )
	{
		if ( defined( 'WP_DEBUG' ) && WP_DEBUG )
		{
			error_log( $message );
		}
	}

	public function add_actions()
	{

		add_action( 'init', function() {
			register_post_type( 'social_posts', array(
				'labels' => array(
					'name' => 'Social Posts',
					'singular_name' => 'Social Post',
					'edit_item' => 'Edit Social Post',
					'view_item' => 'View Social Post',
				),
				'public' => false,
				'show_ui' => true,
				'supports' => array( 'title' ),
			) );
		} );

		// Retrieve new posts if it's time
		add_action( 'init', function() {
			$social_feed_valid = get_transient( 'socialfeed_valid' );
			if ( !$social_feed_valid )
			{
				$facebook = new \SocialFeed\Services\Facebook();
				$facebook->get_posts();
				$instagram = new \SocialFeed\Services\Instagram();
				$instagram->get_posts();
				$twitter = new \SocialFeed\Services\Twitter();
				$twitter->get_posts();
				set_transient( 'socialfeed_valid', true, HOUR_IN_SECONDS );
			}
		} );

		add_action( 'init', function() {
			/* must have this check here, b/c although a new cron event won't be added without it,
			 * the wp_schedule_event() function triggers the action to run immediately, even if
			 * set for a different time of day. */
			if ( ! wp_next_scheduled( 'social_delete_posts' ) ) {
				$local_time_to_run = '1am';
				$timestamp = strtotime( $local_time_to_run ) + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS );
				wp_schedule_event(
					$timestamp,
					'daily',
					'social_delete_posts'
				);
			}
		} );

		// Add the action or social posts deleting
		add_action( 'social_delete_posts', function() {
			$args = array(
				'post_type' => 'social_posts',
				'post_status' => 'any',
				'posts_per_page' => -1,
				'date_query' => array(
					array(
						'column' => 'post_date_gmt',
						'before' => '1 month ago',
					),
				),
			);
			$posts = get_posts($args);
			foreach( $posts as $post )
			{
				$force_delete = true; // bypass trash
				wp_delete_post( $post->ID,  $force_delete );
			}
		} );
	}
}
