<?php

namespace SocialFeed\Services;

class Instagram {
	public static $username = 'afresort';

	public function get_posts()
	{
		$photos = InstagramApi::i()->get_user_photos( self::$username, 20 );


		// Convert from standard objects to InstagramPhoto Objects
		foreach( $photos as $photo )
		{
			$social_post = $photo->generate_socialpost();
			if ( !$social_post->exists() )
			{
				$social_post->save();
			}
			else
			{

			}
		}
	}
}

class InstagramAPI {
	static $i = null;

	public static function i()
	{
		if ( self::$i === null )
		{
			self::$i = new InstagramAPI();
		}
		return self::$i;
	}

	protected function __construct()
	{
		// @TODO -- These are all hard-coded, but should be changed in the future.
		$this->access_token = '38802998.5b9e1e6.0f10397d0ed4459e9918a147925660ee';
		$this->client_id = '29b8c74ff6b64c038fa2f33e07ab3d41';
		$this->client_secret = '3fbd3bbf1c634c30b4eac2803a1e2719';
	}

	/**
	 * @param $username Instagram username
	 * @param int $count How many images to return
	 * @return array Array of InstagramPhoto objects or empty array on failure
	 */
	public function get_user_photos( $username, $count = 20 )
	{
		\SocialFeed\Controller::log( "Getting user: ". $username . ' Photos');
		$user_id = $this->get_user_id_from_username( $username );
		if ( empty( $user_id ) )
		{
			return array();
		}

		try
		{
			$photos = $this->request( 'get', sprintf( 'https://api.instagram.com/v1/users/%d/media/recent/', $user_id ), array(
				'access_token' => $this->access_token,
				'count' => $count,
			) );
		}
		catch ( \Exception $e )
		{
			\SocialFeed\Controller::log( $e->getMessage() );
			return array();
		}

		// Convert from standard objects to InstagramPhoto Objects
		foreach( $photos as &$photo )
		{
			$photo = new InstagramPhoto( $photo );
		}
		return $photos;
	}

	public function get_user_id_from_username( $username )
	{
		try
		{
			$users = $this->request( 'get', 'https://api.instagram.com/v1/users/search', array(
				'q' => $username,
				'access_token' => $this->access_token,
			));
		}
		catch ( \Exception $e )
		{
			\SocialFeed\Controller::log( $e->getMessage() );
			return array();
		}

		$user_id = false;
		foreach( $users as $user )
		{
			if ( strtolower( $user->username ) === strtolower( $username ) ) {
				$user_id = $user->id;
				break;
			}
		}
		return $user_id;
	}

	public function request( $method, $url, $data )
	{
		$function = 'wp_remote_' . strtolower( $method );
		$response = $function( add_query_arg( $data, $url ), array(
			'timeout' => 3,
		) );
		$code = wp_remote_retrieve_response_code( $response );
		if ( intval( $code ) !== 200 )
		{
			throw new \Exception( 'An error occurred and the response code was: '. print_r( $code, 1 ) );
		}

		$body = json_decode( wp_remote_retrieve_body( $response ) );

		// Check for no results
		if ( !is_object( $body ) || empty( $body->data ) )
		{
			throw new \Exception( 'Nothing found.' );
		}
		return $body->data;
	}
}






class InstagramPhoto {
	/**
	 * @param $data StdClass Object that's been json_decoded from the Instagram API
	 */
	public function __construct( $data ) {
		// These properties can have too much info for us, esp. when we're not showing it -- so don't save it
		$properties_to_skip = array(
			'likes',
			'comments',
			//'caption' // had troubles with UTF8 characters not outputting correctly, and since we're not displaying this anywhere, we're skipping for now.
		);
		foreach ( get_object_vars( $data ) as $key => $value )
		{
			if ( in_array( $key, $properties_to_skip ) )
			{
				continue;
			}

			if ( $key == 'images' )
			{
				$this->$key = (array) $value;
			}
			else
			{
				$this->$key = $value;
			}
		}
	}

	public function generate_socialpost()
	{
		$post = new \SocialFeed\Models\SocialPost;
		$post->set( 'service', 'instagram' );
		$post->set( 'date', $this->get_date() );
		$post->set( 'content', $this->get_caption() );
		$post->set( 'thumbnail', $this->get_thumbnail_url() );
		$post->set( 'type', $this->get_type() );
		$post->set( 'url', $this->get_instagram_url() );
		return $post;
	}

	public function get_date()
	{
		return $this->created_time;
	}

	public function get_caption()
	{
		return ( !empty( $this->caption) )
			? $this->caption->text
			: '';
	}












	public function get_type()
	{
		return $this->type;
	}

	public function get_instagram_url()
	{
		return $this->link;
	}

	public function get_thumbnail()
	{
		return $this->images['thumbnail'];
	}
	public function get_thumbnail_url()
	{
		return $this->get_thumbnail()->url;
	}
	public function get_thumbnail_width()
	{
		return $this->get_thumbnail()->width;
	}
	public function get_thumbnail_height()
	{
		return $this->get_thumbnail()->height;
	}

	public function get_fullsize()
	{
		return $this->images->standard_resolution;
	}
	public function get_fullsize_url()
	{
		return $this->get_fullsize()->url;
	}
	public function get_fullsize_width()
	{
		return $this->get_fullsize()->width;
	}
	public function get_fullsize_height()
	{
		return $this->get_fullsize()->height;
	}
}