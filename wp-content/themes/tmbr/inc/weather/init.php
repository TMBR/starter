<?php
/*
Plugin Name: TMBR Weather
Plugin URI:
Description: Integrates with the Forecast.io service to pull latest weather.
Version: 1.0
Author: TMBR
Author URI: http://wearetmbr.com/
*/

class TMBR_Weather {
	static $i = null;
	static $use_cache = true;

	static $forecastio_api_key = '4a61ac678fce86ae6e422ccf744297a5';
	static $forecastio_endpoint = 'https://api.forecast.io/forecast';
	static $lat = '';
	static $lng = '';

	public static function i()
	{
		if ( is_null( self::$i ) )
		{
			self::$i = new TMBR_Weather;
		}
		return self::$i;
	}

	public function add_actions()
	{
		// Default to Jackson, WY Lat/Lng
		add_action( 'init', function() {
			TMBR_Weather::$lat = apply_filters( 'tmbr/weather/latitude', '43.479929' );
			TMBR_Weather::$lng = apply_filters( 'tmbr/weather/longitude', '-110.762428' );
			TMBR_Weather::i()->get_full_weather();
		}, 50 );

		add_action( 'init', function() {
			wp_enqueue_style(
				'weather-icons',
				trailingslashit( get_template_directory_uri() ) . 'inc/weather/vendor/weather-icons/css/weather-icons.min.css',
				array(),
				'1.2'
			);
		} );
	}

	public function get_full_weather()
	{
		$url = add_query_arg(
			array( 'exclude' => 'minutely,hourly,flags' ),
			sprintf(
				self::$forecastio_endpoint . '/%s/%s,%s',
				self::$forecastio_api_key,
				self::$lat,
				self::$lng
			)
		);

		$transient_key = 'forecastio_' . md5( $url );

		$weather_obj = get_transient( $transient_key );
		if ( $weather_obj === false || !self::$use_cache )
		{
			$r = wp_remote_get( $url );
			if ( self::is_valid_response( $r ) )
			{
				$weather_obj = json_decode( self::get_body( $r ) );
				if ( $weather_obj )
				{
					set_transient( $transient_key, $weather_obj, 60 * 60 ); // 1 hour cache
				}
			}
			else
			{
				// @TODO Handle errors better
			}
		}
		return $weather_obj;
	}

	/**
	 * @param $when string|int Either 'current' or an integer representing days from today. (e.g., 1 = tomorrow, 2 = two days from now).
	 * @return bool | Obj False on failure or regular object with weather information for the day.
	 */
	public function get_weather_for_day( $when = 'current' )
	{

		if ( $when != 'current' && ( intval( $when ) > 7 || intval( $when ) < 0 ) )
		{
			error_log( 'Not a valid time for the weather' );
			return false;
		}


		$full_weather_obj = self::get_full_weather();

		$weather_obj = ( $when === 'current' )
			? $full_weather_obj->currently
			: $full_weather_obj->daily->data[$when];

		return $weather_obj;
	}

	public function get_current_temp()
	{
		$weather_obj = $this->get_weather_for_day();
		return $this->get_temp_from_weather( $weather_obj );
	}

	public function get_current_icon()
	{
		$weather_obj = $this->get_weather_for_day();
		return apply_filters(
			'tmbr_weather_current_icon',
			$this->get_icon_from_weather( $weather_obj ),
			$weather_obj
		);
	}

	public function get_temp_from_weather( $weather_obj )
	{
		if ( !is_object( $weather_obj ) || ( !isset( $weather_obj->temperature ) && !isset( $weather_obj->temperatureMax ) ) )
		{
			return '';
		}
		return isset( $weather_obj->temperature )
			? $weather_obj->temperature
			: $weather_obj->temperatureMax;
	}

	public static function get_icon_from_weather( $weather_obj )
	{
		if ( !is_object( $weather_obj ) || empty( $weather_obj->icon ) )
		{
			return '';
		}
		$api_icon = $weather_obj->icon;

		// translate to the font library we're using
		switch ( $api_icon )
		{
			case 'clear-day':
				$icon = 'wi-day-sunny';
				break;
			case 'clear-night':
				$icon = 'wi-night-clear';
				break;
			case 'rain':
				$icon = 'wi-rain';
				break;
			case 'snow':
				$icon = 'wi-snow';
				break;
			case 'sleet':
				$icon = 'wi-day-sleet-storm';
				break;
			case 'wind':
				$icon = 'wi-strong-wind';
				break;
			case 'fog':
				$icon = 'wi-fog';
				break;
			case 'cloudy':
				$icon = 'wi-cloudy';
				break;
			case 'partly-cloudy-day':
				$icon = 'wi-day-cloudy';
				break;
			case 'partly-cloudy-night':
				$icon = 'wi-night-cloudy';
				break;
			case 'hail': // possible response from API in future
				$icon = 'wi-hail';
				break;
			case 'thunderstorm': // possible response from API in future
				$icon = 'wi-thunderstorm';
				break;
			case 'tornado': // possible response from API in future
				$icon = 'wi-tornado';
				break;
			default: // If no response, let's say "sunny"
				$icon = 'wi-day-sunny';
				break;
		}
		return $icon;
	}

	public static function is_valid_response( $response )
	{
		return wp_remote_retrieve_response_code( $response ) == 200;
	}

	public static function get_body( $response )
	{
		return wp_remote_retrieve_body( $response );
	}
}
TMBR_Weather::i()->add_actions();