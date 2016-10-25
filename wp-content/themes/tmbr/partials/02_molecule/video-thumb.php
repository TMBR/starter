<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}
global $post;


/**
 *  ACF - VIDEO (clone field)
 *  ==========================
 *  Checks if variables to get_fields are set in load template,
 *  otherwise sets vars to base video fields
 *
 *  Vars:
 *   $display - 'group', 'seamless'
 *   $label - for 'group' display only
 *   $size - size of image
 *
 *  Used by:
 *   partials/03_organism/gallery-video.php
 */

if(isset($display))
{

  if($display == 'group' && !empty($label)) {
    $url = $label['video_url'];
    $img = $label['video_still'];
    $title = $label['video_title'];
  }

  elseif($display == 'seamless') {
    // could get very granular here and check if clone is sub field or not.
  }

}

/* Assumes that field is getting loaded directly */
else
{
  $url = isset($url) ? $url : get_field('video_url');
  $img = isset($img) ? $img : get_field('video_still');
  $title = isset($text) ? $text : get_field('video_title');
}

$size = isset($size) ? $size : 'medium';

// get vimeo object
$url = $url;
$parsedVidURL = parse_url($url);
$vidPART = $parsedVidURL['path'];
$vidPART = str_replace('/','',$vidPART);
$hash = simplexml_load_file("https://vimeo.com/api/v2/video/$vidPART.xml");
$smUrl =  $hash->video[0]->thumbnail_large;

if(!empty($img)) {
  $vid_img = $img['sizes'][$size];
}
else {
  $vid_img = $smUrl;
}

// BEGIN MARKUP
?>


<div class="video-wrap">
  <a href="<?php echo $url; ?>" class="popup-video js-popup-video">
    <img src="<?php echo $vid_img; ?>" alt="<?php echo $hash->video[0]->title; ?>" class="img-responsive">
    <span class="video-trigger"></span>
  </a>
  <?php if(isset($title)) { echo '<h4 class="title">'. $title .'</h4>';} ?>
</div><!-- /video-wrap -->


