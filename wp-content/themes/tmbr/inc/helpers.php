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
	$imageArr = wp_get_attachment_image_src( $imageId, $size );
	$image = $imageArr[0];
	return $image;
}

/*
** ALLOWS YOU TO OUTPUT EXCERPTS WITH LENGTHS OF YOUR CHOOSING
** Usage: If you want to output an excerpt of 25 words
**	<?php echo tmbr_excerpt(25); ?>
*/

function tmbr_excerpt($limit) {
	 $excerpt = explode(' ', get_the_excerpt(), $limit);
	 if (count($excerpt)>=$limit) {
	 array_pop($excerpt);
	 $excerpt = implode(" ",$excerpt).'...';
	 } else {
	 $excerpt = implode(" ",$excerpt);
	 }
	 $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
	 return $excerpt;
}

/*
** ALLOWS YOU TO OUTPUT CONTENT WITH LENGTHS OF YOUR CHOOSING
** Usage: If you want to output an excerpt of 25 words
**	<?php echo TMBR_content(25); ?>
*/
function tmbr_content($limit) {
	 $content = explode(' ', get_the_content(), $limit);
	 if (count($content)>=$limit) {
	 array_pop($content);
	 $content = implode(" ",$content).'...';
	 } else {
	 $content = implode(" ",$content);
	 }
	 $content = preg_replace('/[.+]/','', $content);
	 $content = apply_filters('the_content', $content);
	 $content = str_replace(']]>', ']]&gt;', $content);
	 return $content;
}