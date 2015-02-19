<?php

// is production switch for serving up compiled stylesheets
function is_production() {
	return ( function_exists('is_wpe') && is_wpe() );
}

function is_staging() {
	return ( function_exists('is_wpe_snapshot') && is_wpe_snapshot() );
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

// Print Pretty var dump
function debug($bug) {
	echo '<pre>';
		print_r($bug);
	echo '</pre>';
}

/*
** ACF Image Helper
**
** @Param $imageId: int - image ID you are using
** @Param $size: string - image size you want to retrieve
** @Return Array - image url and alt text for image
**
EXAMPLE :
$imageObj = tmbr_get_cropped_image( get_field( 'image', $trailHead ), 'archive' );
$imageUrl = $imageObj['url'];
$imageAlt = $imageObj['alt'];
*/

function tmbr_get_cropped_image( $imageId, $size ) {
	$image = array();
	$imageArr = wp_get_attachment_image_src( $imageId, $size );
	$image['url'] = $imageArr[0];
	$image['alt'] = tmbr_get_alt( $imageId );
	return $image;
}
