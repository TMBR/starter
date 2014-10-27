<?php
namespace SocialFeed\Services;

// class Facebook extends abstractService {
class Facebook {

	protected static $appId = '1529407900622307';
	protected static $appSecret = 'd6c7273b902672bf7dabcdd1bda2adbe';

	public static $username = 'angelfireresort';
	public static $endpoint = 'https://graph.facebook.com/v2.1/';

	public function get_posts()
	{
		$facebook_url = add_query_arg(
			array(
				'access_token'  => self::$appId . '|' . self::$appSecret,
			),
			self::$endpoint . self::$username . '/feed/'
		);

		$response = wp_remote_get( $facebook_url );
		$r = json_decode( wp_remote_retrieve_body( $response ) );
		if ( $r )
		{
			foreach ( $r->data as $_post )
			{
				$fbpost = new FBPost( $_post );
				if ( !$fbpost->is_valid() )
				{
					error_log( 'The FB Social Post is not valid: ' );
					error_log( print_r( $fbpost, 1 ) );
					continue;
				}
				$social_post = $fbpost->generate_socialpost();
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

class FBPost {
	public function __construct( $data )
	{
		$this->raw = $data;
	}
	public function is_valid()
	{
		return ( $this->get_content() !== '' && $this->get_url() !== '' );
	}
	public function get_date()
	{
		return strtotime(
			$this->get_property_from_raw( 'created_time', 0 )
		);
	}
	public function get_content()
	{
		return $this->get_property_from_raw( 'message', '' );
	}
	public function get_thumbanil()
	{
		return $this->get_property_from_raw( 'picture', '' );
	}
	public function get_type()
	{
		return $this->get_property_from_raw( 'type', '' );
	}

	public function get_url()
	{
		return $this->get_property_from_raw( 'link', '' );
	}




	public function generate_socialpost()
	{
		$post = new \SocialFeed\Models\SocialPost;
		$post->set( 'service', 'facebook' );
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
