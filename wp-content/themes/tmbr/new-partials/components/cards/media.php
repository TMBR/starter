<?php
/* Required vars:

* $source - this is required so we know where to pull media content from
*
* Used by:
* partials/components/cards/link-card.php
*/


if($source == 'flex_custom' || $source == 'site_custom'){
  $rows = 'lc_custom_media';
  $get_rows = get_sub_field($rows);
}
elseif($source == 'site_hero'){
  $rows = 'flex_hero';
  $get_rows = get_field($rows);
}

// count items - if more than 1, create slider
$total = count($get_rows);
if( $total > 1 ) { $slider = 1; }
else { $slider = 0; }

?>

<section class="card-media">

  <?php
  if($slider) { echo '<div class="js-slider media-slider">'; }

    if($get_rows) :

      while(has_sub_field($rows)) :

        if($source == 'flex_custom' || $source == 'site_custom'){
          $src_type = 'lc_custom_mi_type';
          $src_img = 'lc_custom_mi_image';
          $src_vid_url = 'lc_custom_mi_video_url';
        }
        if($source == 'site_hero'){
          $src_type = 'flex_hero_type';
          $src_img = 'flex_hero_image';
          $src_vid_url = 'flex_hero_video_url';
        }


        $type = get_sub_field($src_type);
        $image = get_sub_field($src_img);
        $url = get_sub_field($src_vid_url);

        if($slider) { echo '<div class="item">'; }
        ?>
          <div class="wrapper <?php echo '-'.$type; ?>">

            <?php
              if($type == 'image') {
                tmbr_load_template( 'new-partials/components/media/img-bg.php', array(
                  'img' => (isset($image)) ? $image : null,
                  'size' => 'full_screen'
                ));
              }
              elseif($type == 'video') {
                tmbr_load_template( 'new-partials/components/media/video.php', array(
                  'img' => (isset($image)) ? $image : null,
                  'size' => 'full_screen',
                  'url' => (isset($url)) ? $url : null
                ));
              }
            ?>

          </div><!-- /wrapper -->
        <?php
        if($slider) { echo '</div><!-- /item -->'; }

      endwhile;

    endif;

  if($slider) { echo '</div><!-- js-slider -->'; }
  ?>

</section>

