<?php

$image = get_sub_field('hp_image');
$header = get_sub_field('hp_header');
$text = get_sub_field('hp_text');
$btnTxt = get_sub_field('hp_button_text');
$btnLink = get_sub_field('hp_button_link');

?>

<?php if(get_field('hp_slideshow')) :?>
<div id="home-slider" class="flexslider">
  
    <ul class="slides">
    <?php while(has_sub_field('hp_slideshow')) : ?>

      <li>
        <img src="<?php echo $image['sizes']['full_screen'];?>" alt="<?php echo $image['alt'];?>"/>

        <div class="caption">
          <?php if ( $header ) { ?>
            <h2><?php echo $header; ?></h2>
          <?php } 

          if ( $text ) { ?>
            <p><?php echo $text; ?></p>
          <?php }

          if ( $btnTxt ) { ?> 
            <a href="<?php echo $btnLink; ?>" class="btn"><?php echo $btnTxt; ?></a>
          <?php } ?>
        </div><!-- /caption -->
        
      </li>
      
    <?php endwhile; ?>
    </ul>

</div><!-- #home-slider -->

<?php else : ?>

<div id="fullscreen_slider" class="flexslider">
  <ul class="slides">
    <li>
      <img src="http://placehold.it/800x400/e2e2e2/FFFFFF" />
    </li>
    <li>
      <img src="http://placehold.it/800x400/e2e2e2/FFFFFF" />
    </li>
    <li>
      <img src="http://placehold.it/800x400/e2e2e2/FFFFFF" />
    </li>
    <li>
      <img src="http://placehold.it/800x400/e2e2e2/FFFFFF" />
    </li>
  </ul>
</div>

<?php endif; ?>
