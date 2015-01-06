<?php

// is production switch for serving up compiled stylesheets
function is_production() {
	if( defined('ENVIRONMENT') && EVIRONMENT == 'production' ) {
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
