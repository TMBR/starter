<?php
namespace SocialFeed\Services;

class Twitter {

	private static $apiKey = '6LEEpQa9tgx8syvizQOPRCCK8';
	private static $apiSecret = 'YsrMsRzxQ84tGWEgcGuG304bEzYEQuEJxaIZYBoQBOGVP39iyA';
	/*
	Overview of how to get a token to make requests...
	1) Generate a temporary token via this:
		$tmp_token = base64_encode( $apiKey . ':' . $apiSecret );
	2) POST request to "https://api.twitter.com/oauth2/token" with the following
		Headers:
		- Authorization: Basic {$tmp_token}
		- Content-Type: application/x-www-form-urlencoded;charset=UTF-8
		Body of the request:
		"grant_type=client_credentials" (without the quotes)

	3) This provides the bearer token that's used when making the actual API requests
	*/
	private static $bearer_token = 'AAAAAAAAAAAAAAAAAAAAAN%2BxZQAAAAAAmYX7N4DXfDoHFT13DLm4OItzJR0%3DjHsFkhcSb5oQVLE2wT52bxSB0mFdzx2lG01gCds9hvd2oizOwM';

	public static $username = 'angelfireresort';
	public static $endpoint = 'https://api.twitter.com/1.1/statuses/user_timeline.json';

	public function get_posts()
	{
		$url = add_query_arg(
			array(
				'screen_name' => self::$username,
				'exclude_replies' => 'true',
			),
			self::$endpoint
		);

		$response = wp_remote_get( $url, array(
			'headers' => array(
				'Authorization' => 'Bearer ' . self::$bearer_token,
			)
		) );
		$r = json_decode( wp_remote_retrieve_body( $response ) );

		if ( $r )
		{
			foreach ( $r as $raw_tweet )
			{
				$tweet = new Tweet( $raw_tweet );
				$social_post = $tweet->generate_socialpost();
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
}

class Tweet {
	public function __construct( $data )
	{
		$this->raw = $data;
	}
	public function get_date()
	{
		return strtotime(
			$this->get_property_from_raw( 'created_at', 0 )
		);
	}
	public function get_content()
	{
		return $this->get_property_from_raw( 'text', '' );
	}
	public function get_thumbanil()
	{
		$url = '';
		if ( $this->has_media() )
		{
			$media_item = $this->get_media();
			$url = $media_item->media_url_https . ':thumb';
		}
		return $url;
	}
	protected function get_media()
	{
		$entities = $this->get_property_from_raw( 'extended_entities', '' );
		return ( $entities && isset( $entities->media ) && is_array( $entities->media ) )
			? $entities->media[0]
			: false;
	}
	protected function has_media()
	{
		$entities = $this->get_property_from_raw( 'extended_entities', '' );
		return ( $entities && isset( $entities->media ) && is_array( $entities->media ) );
	}
	public function get_type()
	{
		return ( $this->has_media() )
			? 'image'
			: 'text';
	}

	public function get_url()
	{
		$username = 'angelfireresort';
		return sprintf(
			'https://twitter.com/%s/status/%s',
			$username,
			$this->get_property_from_raw( 'id_str', '' )
		);

	}




	public function generate_socialpost()
	{
		$post = new \SocialFeed\Models\SocialPost;
		$post->set( 'service', 'twitter' );
		$post->set( 'date', $this->get_date() );
		$post->set( 'content', $this->get_content() );
		$post->set( 'thumbnail', $this->get_thumbanil() );
		$post->set( 'type', $this->get_type() );
		$post->set( 'url', $this->get_url() );
		return $post;
	}

	protected function get_property_from_raw( $prop, $default = '' )
	{
		return isset( $this->raw->{$prop} )
			? $this->raw->{$prop}
			: $default;
	}
}
