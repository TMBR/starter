<?php

// Theme Setup & Support
// http://codex.wordpress.org/Function_Reference/add_theme_support

add_action('after_setup_theme', 'tmbr_setup');

function tmbr_setup() {

	add_theme_support('automatic-feed-links');
	add_theme_support('post-thumbnails');

}

// ADD TMBR LOGO TO LOGIN PAGE
add_action('login_head', 'tmbr_login_head');
function tmbr_login_head() {
	echo "
	<style>
		body.login #login h1 a {
			background: url('".get_bloginfo('template_url')."/assets/img/tmbr-logo.png') no-repeat scroll center top transparent;
			height: 160px;
			width: 140px;
			margin: 0 auto;
		}
	</style>
	";
}

// add ie conditional html5 shim to header
// http://css-tricks.com/snippets/wordpress/html5-shim-in-functions-php/
function add_ie_html5_shim () {
	echo '<!--[if lt IE 9]>';
	echo '<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>';
	echo '<![endif]-->';
}
add_action('wp_head', 'add_ie_html5_shim');

// is production switch for serving up compiled stylesheets
function is_production() {
	if(defined('ENVIRONMENT') && EVIRONMENT == 'production') {
		return true;
	} else {
		return false;
	}
}

function _s_asset($target) {
	return get_stylesheet_directory_uri() . '/public/' . $target;
}

// asset revving for serving up hashed files
// use `gulp build` to generate new releases and builds
function _s_revved_asset($target) {
	$scripts = file_get_contents(STYLESHEETPATH . '/public/rev-manifest.json');
	$scripts = json_decode($scripts);
	if ( isset( $scripts->{$target} ) ) {
		return get_stylesheet_directory_uri() . '/public/' . $scripts->{$target};
	}
	return $target . ' :: file-not-found-in-public-dir';
}

?>