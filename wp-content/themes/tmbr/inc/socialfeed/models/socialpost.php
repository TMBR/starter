<?php

namespace SocialFeed\Models;

class SocialPost {
	protected static $storage_engine = 'post';

	public function generate_key()
	{
		return md5( serialize( $this ) );
	}

	public function exists()
	{
		if ( self::$storage_engine === 'post' )
		{
			$args = array(
				'post_type' => 'social_posts',
				'posts_per_page' => 1,
				'meta_query' => array(
					array(
						'key' => 'socialpost_key',
						'value' => $this->generate_key(),
					),
				),
				'post_status' => 'any',
			);
			$posts = get_posts( $args );
			return empty( $posts )
				? false
				: $posts[0]->ID;
		}
		else
		{
			$all_posts = maybe_unserialize( get_option( 'social_feed_posts' ) );
			return array_key_exists( $this->generate_key(), (array) $all_posts );
		}

	}

	public function save()
	{
		if ( self::$storage_engine === 'post' )
		{
			$post_id = wp_insert_post( array(
				'post_type' => 'social_posts',
				'post_title' => $this->get_title_to_save(),
				'post_date' => date( 'Y-m-d H:i:s', $this->get_date() ),
				'post_content' => $this->get_content(),
				'post_status' => 'publish',
			) );
			update_post_meta( $post_id, 'socialpost_key', $this->generate_key() );
			update_post_meta( $post_id, 'socialpost_data', get_object_vars( $this ) );
		}
		else
		{
			$current_posts = maybe_unserialize( get_option( 'social_feed_posts' ) );
			if ( !is_array( $current_posts ) )
			{
				$new_posts = array( $this );
			}
			else {
				$new_posts = array();
				$injected = false;
				foreach ( $current_posts as $social_post )
				{
					if ( $injected )
					{
						$new_posts[$social_post->generate_key()] = $social_post;
					}
					else
					{
						if ( $social_post->get_date() >= $this->get_date() )
						{
							$new_posts[$social_post->generate_key()] = $social_post;
						}
						else
						{
							$new_posts[$this->generate_key()] = $this;
							$new_posts[$social_post->generate_key()] = $social_post;
							$injected = true;
						}
					}
				}
				// If we're still false at the end, put our post at the end.
				if ( $injected === false )
				{
					$new_posts[$this->generate_key()] = $this;
				}
			}
			update_option( 'social_feed_posts', $new_posts );
		}
	}

	public function retrieve( $id )
	{
		$props = get_post_meta( $id, 'socialpost_data', true );
		foreach ( $props as $prop => $value )
		{
			$this->$prop = $value;
		}
	}

	public function get_title_to_save()
	{
		// {service} :: {first 25 chars of content}
		return $this->get( 'service' ) . ' :: ' . substr( $this->get( 'content' ), 0, 25 );
	}
	public function set( $prop, $value )
	{
		$this->{$prop} = $value;
	}
	public function get( $prop )
	{
		return isset( $this->{$prop} )
			? $this->{$prop}
			: '';
	}
	public function get_service() {
		return $this->get( 'service' );
	}
	public function get_date() {
		return $this->get( 'date' );
	}
	public function get_content() {
		return $this->get( 'content' );
	}
	public function get_thumbnail() {
		return $this->get( 'thumbnail' );
	}
	public function get_type() {
		return $this->get( 'type' );
	}
	public function get_url() {
		return $this->get( 'url' );
	}
}