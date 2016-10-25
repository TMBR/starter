<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

global $post;

/**
 *  ACF - Video Gallery (clone field)
 *
 *  Vars:
 *   $display - 'group', 'seamless'
 *   $label - for 'group' display only
 *
 *  Used by:
 *   partials/03_organism/get-flex-layouts.php
 */

/* Clone fields display type */
if(isset($display))
{

  if($display == 'group' && !empty($label)) {
    $header = $label['vg_header'];
    $videos = $label['video_gallery'];
  }

  elseif($display == 'seamless') {
    $header = isset($header) ? $header : get_sub_field('vg_header');
    $videos = isset($videos) ? $videos : get_sub_field('video_gallery');
  }

}

/* Assumes that field is getting loaded directly */
else
{
  $header = isset($header) ? $header : get_field('vg_header');
  $videos = isset($videos) ? $videos : get_field('video_gallery');
}


// BEGIN MARKUP
if( $videos ) :
?>



<section class="video-gallery">
  <?php if(isset($header)) { echo '<h2 class="title text-center">'. $header .'</h2>'; } ?>
  <div class="container-fluid stop1440">
    <div class="row">
      <?php
      foreach( $videos as $video ) :
        $video_item = $video['video_item'];
      ?>

      <div class="col-md-2 col-xs-4">
        <?php
        tmbr_load_template( 'partials/02_molecule/video-thumb.php', array(
          'display' => 'group',
          'label' => (isset($video_item)) ? $video_item : null
        ));
        ?>
      </div><!-- /col -->
    <?php endforeach; ?>
    </div><!-- /row -->
  </div><!-- /container -->
</section>

<?php endif;
