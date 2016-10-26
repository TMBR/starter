<?php
/**
 * Main Tribe Common class.
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if ( class_exists( 'Tribe__Main' ) ) {
	return;
}

class Tribe__Main {
	const EVENTSERROROPT      = '_tribe_events_errors';
	const OPTIONNAME          = 'tribe_events_calendar_options';
	const OPTIONNAMENETWORK   = 'tribe_events_calendar_network_options';

	const VERSION           = '4.3.1';
	const FEED_URL          = 'https://theeventscalendar.com/feed/';

	protected $plugin_context;
	protected $plugin_context_class;
	protected $doing_ajax = false;
	protected $log;

	/**
	 * Manages PUE license key notifications.
	 *
	 * It's important for the sanity of our users that only one instance of this object
	 * be created. However, multiple Tribe__Main objects can and will be instantiated, hence
	 * why for the time being we need to make this field static.
	 *
	 * @see https://central.tri.be/issues/65755
	 *
	 * @var Tribe__PUE__Notices
	 */
	protected static $pue_notices;

	public static $tribe_url = 'http://tri.be/';
	public static $tec_url = 'https://theeventscalendar.com/';

	public $plugin_dir;
	public $plugin_path;
	public $plugin_url;

	/**
	 * constructor
	 */
	public function __construct( $context = null ) {
		if ( is_object( $context ) ) {
			$this->plugin_context = $context;
			$this->plugin_context_class = get_class( $context );
		}

		$this->plugin_path = trailingslashit( dirname( dirname( dirname( __FILE__ ) ) ) );
		$this->plugin_dir  = trailingslashit( basename( $this->plugin_path ) );

		$parent_plugin_dir = trailingslashit( plugin_basename( $this->plugin_path ) );

		$this->plugin_url  = plugins_url( $parent_plugin_dir === $this->plugin_dir ? $this->plugin_dir : $parent_plugin_dir );

		$this->load_text_domain( 'tribe-common', basename( dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) ) . '/common/lang/' );

		$this->init_autoloading();

		$this->init_libraries();
		$this->add_hooks();

		$this->doing_ajax = defined( 'DOING_AJAX' ) && DOING_AJAX;

		/**
		 * Runs once all common libs are loaded and initial hooks are in place.
		 *
		 * @since 4.3
		 */
		do_action( 'tribe_common_loaded' );
	}

	/**
	 * Get's the instantiated context of this class. I.e. the object that instantiated this one.
	 */
	public function context() {
		return $this->plugin_context;
	}

	/**
	 * Setup the autoloader for common files
	 */
	protected function init_autoloading() {
		if ( ! class_exists( 'Tribe__Autoloader' ) ) {
			require_once dirname( __FILE__ ) . '/Autoloader.php';
		}

		$autoloader = Tribe__Autoloader::instance();

		$prefixes = array( 'Tribe__' => dirname( __FILE__ ) );
		$autoloader->register_prefixes( $prefixes );

		foreach ( glob( $this->plugin_path . 'src/deprecated/*.php' ) as $file ) {
			$class_name = str_replace( '.php', '', basename( $file ) );
			$autoloader->register_class( $class_name, $file );
		}

		$autoloader->register_autoloader();
	}

	/**
	 * Get's the class name of the instantiated plugin context of this class. I.e. the class name of the object that instantiated this one.
	 */
	public function context_class() {
		return $this->plugin_context_class;
	}

	/**
	 * initializes all required libraries
	 */
	public function init_libraries() {
		Tribe__Debug::instance();
		Tribe__Settings_Manager::instance();
		$this->pue_notices();

		require_once $this->plugin_path . 'src/functions/utils.php';
		require_once $this->plugin_path . 'src/functions/template-tags/general.php';
		require_once $this->plugin_path . 'src/functions/template-tags/date.php';

		// Starting the log manager needs to wait until after the tribe_*_option() functions have loaded
		$this->log = new Tribe__Log();
	}

	/**
	 * Registers resources that can/should be enqueued
	 */
	public function load_assets() {
		// These ones are only registred
		tribe_assets(
			$this,
			array(
				array( 'tribe-clipboard', 'vendor/clipboard/clipboard.js' ),
				array( 'datatables', 'vendor/datatables/media/js/jquery.dataTables.js', array( 'jquery' ) ),
				array( 'datatables-css', 'datatables.css' ),
				array( 'datatables-responsive', 'vendor/datatables/extensions/Responsive/js/dataTables.responsive.js', array( 'jquery', 'datatables' ) ),
				array( 'datatables-responsive-css', 'vendor/datatables/extensions/Responsive/css/responsive.dataTables.css' ),
				array( 'datatables-select', 'vendor/datatables/extensions/Select/js/dataTables.select.js', array( 'jquery', 'datatables' ) ),
				array( 'datatables-select-css', 'vendor/datatables/extensions/Select/css/select.dataTables.css' ),
				array( 'datatables-scroller', 'vendor/datatables/extensions/Scroller/js/dataTables.scroller.js', array( 'jquery', 'datatables' ) ),
				array( 'datatables-scroller-css', 'vendor/datatables/extensions/Scroller/css/scroller.dataTables.css' ),
				array( 'datatables-fixedheader', 'vendor/datatables/extensions/FixedHeader/js/dataTables.fixedHeader.js', array( 'jquery', 'datatables' ) ),
				array( 'datatables-fixedheader-css', 'vendor/datatables/extensions/FixedHeader/css/fixedHeader.dataTables.css' ),
				array( 'tribe-datatables', 'tribe-datatables.js', array( 'datatables', 'datatables-select' ) ),
				array( 'tribe-bumpdown', 'bumpdown.js', array( 'jquery', 'underscore', 'hoverIntent' ) ),
				array( 'tribe-bumpdown-css', 'bumpdown.css' ),
			)
		);

		// These ones will be enqueued on `admin_enqueue_scripts` if the conditional method on filter is met
		tribe_assets(
			$this,
			array(
				array( 'tribe-common-admin', 'tribe-common-admin.css', array( 'tribe-dependency-style', 'tribe-bumpdown-css' ) ),
				array( 'tribe-dependency', 'dependency.js', array( 'jquery', 'underscore' ) ),
				array( 'tribe-dependency-style', 'dependency.css' ),
				array( 'tribe-pue-notices', 'pue-notices.js', array( 'jquery' ) ),
				array( 'tribe-jquery-ui-theme', 'vendor/jquery/ui.theme.css' ),
				array( 'tribe-jquery-ui-datepicker', 'vendor/jquery/ui.datepicker.css' ),
			),
			'admin_enqueue_scripts',
			array(
				'filter' => array( Tribe__Admin__Helpers::instance(), 'is_post_type_screen' ),
				'localize' => (object) array(
					'name' => 'tribe_system_info',
					'data' => array(
						'sysinfo_optin_nonce'   => wp_create_nonce( 'sysinfo_optin_nonce' ),
						'clipboard_btn_text'    => __( 'Copy to clipboard', 'tribe-common' ),
						'clipboard_copied_text' => __( 'System info copied', 'tribe-common' ),
						'clipboard_fail_text'   => __( 'Press "Cmd + C" to copy', 'tribe-common' ),
					),
				),
			)
		);

		tribe_asset(
			$this,
			'tribe-common',
			'tribe-common.js',
			array( 'tribe-clipboard' ),
			'admin_enqueue_scripts',
			array(
				'localize' => array(
					'name' => 'tribe_l10n_datatables',
					'data' => array(
						'aria' => array(
							'sort_ascending' => __( ': activate to sort column ascending', 'tribe-common' ),
							'sort_descending' => __( ': activate to sort column descending', 'tribe-common' ),
						),
						'length_menu'   => __( 'Show _MENU_ entries', 'tribe-common' ),
						'empty_table'   => __( 'No data available in table', 'tribe-common' ),
						'info'          => __( 'Showing _START_ to _END_ of _TOTAL_ entries', 'tribe-common' ),
						'info_empty'    => __( 'Showing 0 to 0 of 0 entries', 'tribe-common' ),
						'info_filtered' => __( '(filtered from _MAX_ total entries)', 'tribe-common' ),
						'zero_records'  => __( 'No matching records found', 'tribe-common' ),
						'search'        => __( 'Search:', 'tribe-common' ),
						'pagination' => array(
							'all' => __( 'All', 'tribe-common' ),
							'next' => __( 'Next', 'tribe-common' ),
							'previous' => __( 'Previous', 'tribe-common' ),
						),
						'select' => array(
							'rows' => array(
								0 => '',
								'_' => __( ': Selected %d rows', 'tribe-common' ),
								1 => __( ': Selected 1 row', 'tribe-common' ),
							),
						),
					),
				),
			)
		);
	}

	/**
	 * Adds core hooks
	 */
	public function add_hooks() {
		add_action( 'plugins_loaded', array( 'Tribe__App_Shop', 'instance' ) );
		add_action( 'plugins_loaded', array( 'Tribe__Assets', 'instance' ), 1 );
		add_action( 'plugins_loaded', array( $this, 'tribe_plugins_loaded' ), PHP_INT_MAX );

		// Register for the assets to be available everywhere
		add_action( 'init', array( $this, 'load_assets' ), 1 );
		add_action( 'plugins_loaded', array( 'Tribe__Admin__Notices', 'instance' ), 1 );
		add_action( 'admin_enqueue_scripts', array( $this, 'store_admin_notices' ) );
	}

	/**
	 * A Helper method to load text domain
	 * First it tries to load the wp-content/languages translation then if falls to the
	 * try to load $dir language files
	 *
	 * @param string $domain The text domain that will be loaded
	 * @param string $dir    What directory should be used to try to load if the default doenst work
	 *
	 * @return bool  If it was able to load the text domain
	 */
	public function load_text_domain( $domain, $dir = false ) {
		// Added safety just in case this runs twice...
		if ( is_textdomain_loaded( $domain ) && ! is_a( $GLOBALS['l10n'][ $domain ], 'NOOP_Translations' ) ) {
			return true;
		}

		$locale = get_locale();
		$mofile = WP_LANG_DIR . '/plugins/' . $domain . '-' . $locale . '.mo';

		/**
		 * Allows users to filter which file will be loaded for a given text domain
		 * Be careful when using this filter, it will apply across the whole plugin suite.
		 *
		 * @param string      $mofile The path for the .mo File
		 * @param string      $domain Which plugin domain we are trying to load
		 * @param string      $locale Which Language we will load
		 * @param string|bool $dir    If there was a custom directory passed on the method call
		 */
		$mofile = apply_filters( 'tribe_load_text_domain', $mofile, $domain, $locale, $dir );

		$loaded = load_plugin_textdomain( $domain, false, $mofile );

		if ( $dir !== false && ! $loaded ) {
			return load_plugin_textdomain( $domain, false, $dir );
		}

		return $loaded;
	}

	/**
	 * @return Tribe__Log
	 */
	public function log() {
		return $this->log;
	}

	/**
	 * @return Tribe__PUE__Notices
	 */
	public function pue_notices() {
		if ( empty( self::$pue_notices ) ) {
			self::$pue_notices = new Tribe__PUE__Notices;
		}

		return self::$pue_notices;
	}

	/**
	 * Returns the post types registered by Tribe plugins
	 */
	public static function get_post_types() {
		// we default the post type array to empty in tribe-common. Plugins like TEC add to it
		return apply_filters( 'tribe_post_types', array() );
	}

	/**
	 * Insert an array after a specified key within another array.
	 *
	 * @param $key
	 * @param $source_array
	 * @param $insert_array
	 *
	 * @return array
	 *
	 */
	public static function array_insert_after_key( $key, $source_array, $insert_array ) {
		if ( array_key_exists( $key, $source_array ) ) {
			$position     = array_search( $key, array_keys( $source_array ) ) + 1;
			$source_array = array_slice( $source_array, 0, $position, true ) + $insert_array + array_slice( $source_array, $position, null, true );
		} else {
			// If no key is found, then add it to the end of the array.
			$source_array += $insert_array;
		}

		return $source_array;
	}

	/**
	 * Insert an array immediately before a specified key within another array.
	 *
	 * @param $key
	 * @param $source_array
	 * @param $insert_array
	 *
	 * @return array
	 */
	public static function array_insert_before_key( $key, $source_array, $insert_array ) {
		if ( array_key_exists( $key, $source_array ) ) {
			$position     = array_search( $key, array_keys( $source_array ) );
			$source_array = array_slice( $source_array, 0, $position, true ) + $insert_array + array_slice( $source_array, $position, null, true );
		} else {
			// If no key is found, then add it to the end of the array.
			$source_array += $insert_array;
		}

		return $source_array;
	}

	/**
	 * Helper function for getting Post Id. Accepts null or a post id. If no $post object exists, returns false to avoid a PHP NOTICE
	 *
	 * @param int $post (optional)
	 *
	 * @return int post ID or False
	 */
	public static function post_id_helper( $post = null ) {
		if ( ! is_null( $post ) && is_numeric( $post ) > 0 ) {
			return (int) $post;
		} elseif ( is_object( $post ) && ! empty( $post->ID ) ) {
			return (int) $post->ID;
		} else {
			if ( ! empty( $GLOBALS['post'] ) && $GLOBALS['post'] instanceof WP_Post ) {
				return get_the_ID();
			} else {
				return false;
			}
		}
	}

	/**
	 * Helper function to indicate whether the current execution context is AJAX
	 *
	 * This method exists to allow us test code that behaves differently depending on the execution
	 * context.
	 *
	 * @since 4.0
	 * @return boolean
	 */
	public function doing_ajax( $doing_ajax = null ) {
		if ( ! is_null( $doing_ajax ) ) {
			$this->doing_ajax = $doing_ajax;
		}

		return $this->doing_ajax;
	}

	/**
	 * Static Singleton Factory Method
	 *
	 * @return Tribe__Main
	 */
	public static function instance() {
		static $instance;

		if ( ! $instance ) {
			$instance = new self;
		}

		return $instance;
	}

	/**
	 * Adds a hook
	 *
	 */
	public function store_admin_notices( $page ) {
		if ( 'plugins.php' !== $page ) {
			return;
		}
		$notices = apply_filters( 'tribe_plugin_notices', array() );
		wp_localize_script( 'tribe-pue-notices', 'tribe_plugin_notices', $notices );
	}

	/**
	 * Runs tribe_plugins_loaded action, should be hooked to the end of plugins_loaded
	 */
	public function tribe_plugins_loaded() {
		/**
		 * Runs after all plugins including Tribe ones have loaded
		 *
		 * @since 4.3
		 */
		do_action( 'tribe_plugins_loaded' );
	}
}
