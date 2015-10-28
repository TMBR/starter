

<div id="home-slider" class="flexslider">

  <ul class="slides">

    <?php 

    if ( get_field( 'hp_slideshow' ) ) { 
      while(has_sub_field('hp_slideshow')) {

      $image = get_sub_field('hp_image');
      $header = get_sub_field('hp_header');
      $text = get_sub_field('hp_text');
      $btnTxt = get_sub_field('hp_button_text');
      $btnLink = get_sub_field('hp_button_link'); ?>
    
    <li>

      <img src="<?php echo $image['url'];?>" alt="<?php echo $image['alt'];?>"/>

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
    
  <?php } } else { ?>

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

  <?php } ?>
  
  </ul>
  
</div><!-- #home-slider -->
