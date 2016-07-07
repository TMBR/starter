<?php

// vars
$hero = get_field('flex_hero');
$total = count($hero);

// count items - if more than 1, create slider
if( $total > 1 ) { $slider = 1; }
else { $slider = 0; }

?>


<section class="page-hero">

  <?php

  if($slider) { echo '<div class="js-slider hero-slider">'; }

  if($hero) :

    $count = 1;
    while(has_sub_field('flex_hero')) :

      // row vars
      $type = get_sub_field('flex_hero_type');
      $image = get_sub_field('flex_hero_image');
      $url = get_sub_field('flex_hero_video_url');

      if($slider) { echo '<div class="item">'; } ?>

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

        <?php if( have_rows('flex_hero_content') ) : ?>
          <div class="caption">
            <?php
            while ( have_rows('flex_hero_content') ) :

              the_row();

              if( get_row_layout() == 'fhc_header' )   {
                $header = get_sub_field('fhc_header_text');
                if(isset($header)){ echo '<h3>'.$header.'</h3>'; }

              }
              elseif( get_row_layout() == 'fhc_text' )   { ?>
                <p><?php echo get_sub_field('fhc_text_area'); ?></p>
              <?php }
              elseif( get_row_layout() == 'fhc_btn' )   { ?>
                <a href="<?php echo get_sub_field('fhc_btn_link'); ?>" class="btn"><?php echo get_sub_field('fhc_btn_text'); ?></a>
              <?php }

            endwhile;
            ?>
          </div><!-- /caption -->
        <?php endif; ?>

      </div><!-- /wrapper -->

      <?php
      if($slider) { echo '</div><!-- /item -->'; }


    $count++;
    endwhile;

  endif;


  if($slider) { echo '</div><!-- js-slider -->'; }
  ?>
</section><!-- /page-hero -->