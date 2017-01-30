<?php


/**
 * Class Tribe__Events__Pro__Integrations__WPML__Defaults
 *
 * Handles sensible defaults for to The Events Calendar Pro in WPML.
 */
class Tribe__Events__Pro__Integrations__WPML__Defaults extends  Tribe__Events__Integrations__WPML__Defaults  {

	/**
	 * @var Tribe__Events__Pro__Integrations__WPML__Defaults
	 */
	protected static $instance;

	/**
	 * @var string The name of the sub-option that will store the first run flag.
	 */
	public $defaults_option_name = 'wpml_did_set_pro_defaults';

	/**
	 * The class singleton constructor
	 *
	 * @return Tribe__Events__Pro__Integrations__WPML__Defaults
	 */
	public static function instance() {
		if ( empty( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Returns a list of The Events Calendar related fields that should be copied in translation by default.
	 *
	 * This is not a per-event setting but a per-site setting.
	 *
	 * @return array
	 */
	protected function get_default_copy_fields() {
		$default_copy_fields = array(
			'_EventRecurrence',
		);

		// The reason this array is not filtered is that each plugin should act independently in setting
		// its own specific defaults, plus this array will be parse once per site and concurrency cannot be
		// granted.
		return $default_copy_fields;
	}
}