<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

global $post;

/**
 *  Page Hero
 */

$type = get_field('page_hero_type');
?>
<section class="page-hero <?php echo 'hero-'.$type; ?>">
  <?php
  if($type == 'default') { ?>
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
      <?php

      $title = get_field('custom_page_title');
      $intro = get_field('intro_text');
      if(isset($title)) {
        $title = $title;
      }
      else {
        $title = get_the_title();
      }
      echo '<h1>'. $title .'</h1>';
      if(isset($intro)) {
        echo '<p class="lead">'.$intro.'</p>';
      }
      ?>
      </div>
    </div>
  </div>
    <?php
  }
  elseif($type == 'slider') {
    $label = get_field('hero_slider');
    tmbr_load_template( 'partials/03_organism/media-slider.php', array(
      'display' => 'group',
      'label' => (isset($label)) ? $label : null
    ));
  }
  ?>

</section>