
<?php

$rows = 'fm_mi_media';
$get_rows = get_sub_field($rows);

$total = count($get_rows);
if( $total > 1 ) { $slider = 1; }
else { $slider = 0; }

?>

<section class="media-item pt2 pb4">

  <?php
  if($slider) { echo '<div class="js-slider media-slider">'; }

    if($get_rows) :

      while(has_sub_field($rows)) :

        $type = get_sub_field('fm_mi_type');
        $image = get_sub_field('fm_mi_image');
        $url = get_sub_field('fm_mi_video_url');

        if($slider) {  ?>
        <div class="item">
          <div class="wrapper -media <?php echo '-'.$type; ?>">
            <?php
              if($type == 'image') {
                tmbr_load_template( 'new-partials/components/media/img-bg.php', array(
                  'img' => (isset($image)) ? $image : null,
                  'size' => 'full_screen'
                ));
              }
              elseif($type == 'video') {
                tmbr_load_template( 'new-partials/components/media/video-bg.php', array(
                  'img' => (isset($image)) ? $image : null,
                  'size' => 'full_screen',
                  'url' => (isset($url)) ? $url : null
                ));
              }
            ?>
          </div><!-- /wrapper -->
        </div><!-- /item -->

        <?php
      }

      // if not slider
      else
      { ?>
      <div class="row">
        <div class="col-xs-12">
          <?php if($type == 'image') { ?>
          <img src="<?php echo $image['sizes']['large']; ?>" class="img-responsive" alt="<?php echo $image['alt']; ?>" />
          <?php }

          elseif($type == 'video') {
            tmbr_load_template( 'new-partials/components/media/video-obj.php', array(
              'img' => (isset($image)) ? $image : null,
              'size' => 'full_screen',
              'url' => (isset($url)) ? $url : null
            ));
          }
          ?>
          </div><!-- /col -->
        </div><!-- /row -->
        <?php
      }
      endwhile;
    endif;

  if($slider) { echo '</div><!-- js-slider -->'; } ?>

</section><!-- /media-item -->
