<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

global $post;

/**
 *  ACF - Media Slider (clone field)
 *
 *  Dependent upon:
 *   partials/02_molecule/image-caption-overlay.php
 *   partials/02_molecule/video-thumb.php
 *
 *  Used by:
 *   partials/03_organism/get-flex-layouts.php
 */


if(!isset($jsClass)) {
  $jsClass = 'js-slider';
}

if( have_rows('media_items') ) :
  echo '<section class="media-slider '. $jsClass .'">';

  while( have_rows('media_items')) : the_row();
    echo '<div class="item">';

    $type = get_sub_field('media_type');
    if( $type == 'image' ) {
      $image_item = get_sub_field('image_item');
      tmbr_load_template( 'partials/02_molecule/image-caption-overlay.php', array(
        'display' => 'group',
        'label' => (isset($image_item)) ? $image_item : null
      ));
    }
    elseif( $type == 'video' ) {
      $video_item = get_sub_field('video_item');
      tmbr_load_template( 'partials/02_molecule/video-thumb.php', array(
        'display' => 'group',
        'label' => (isset($video_item)) ? $video_item : null
      ));
    }

    echo '</div><!-- /item -->';
  endwhile;

  echo '</section><!-- /media-slider -->';
endif;





