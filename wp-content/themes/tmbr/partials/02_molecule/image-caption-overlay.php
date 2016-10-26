<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}
global $post;


/**
 *  ACF - IMAGE W CAPTION (clone field)
 *  ==========================
 *  Vars:
 *   $display - 'group', 'seamless'
 *   $label - for 'group' display only
 *   $size - size of image
 *
 *  Used by:
 *   partials/03_organism/media-slider.php
 *
 *  Dependent upon:
 *   partials/01_atom/button.php
 */

if(isset($display))
{

  if($display == 'group' && !empty($label)) {
    $img_obj = $label['iwc_image'];
    $header = $label['iwc_header'];
    $text = $label['iwc_text'];
    $button = $label['iwc_button'];
  }

  elseif($display == 'seamless') {
    $img_obj = isset($img_obj) ? $img_obj : get_sub_field('iwc_image');
    $header = isset($header) ? $header : get_sub_field('iwc_header');
    $text = isset($text) ? $text : get_sub_field('iwc_text');
    $button = isset($button) ? $button : get_sub_field('iwc_button');
  }

}

/* Assumes that field is getting loaded directly */
else
{
  $img_obj = isset($img_obj) ? $img_obj : get_field('iwc_image');
  $header = isset($header) ? $header : get_field('iwc_header');
  $text = isset($text) ? $text : get_field('iwc_text');
  $button = isset($button) ? $button : get_field('iwc_button');
}

$size = isset($size) ? $size : 'full_screen';

$image = $img_obj['sizes'][$size];

// BEGIN MARKUP
?>


<div class="image-caption-overlay">
  <img src="<?php if(!empty($image)) { echo $image; } else { echo backup_img($size); } ?>" alt="<?php echo $img_obj['alt']; ?>" class="img" />
  <div class="caption">
    <?php
    if(isset($header)) {
      echo '<h4 class="title">'. $header .'</h4>';
    }

    if(isset($text)) {
      echo '<p class="text">'. $text .'</p>';
    }

    tmbr_load_template( 'partials/01_atom/button.php', array(
      'display' => 'group',
      'label' => (isset($button)) ? $button : null
    ));
    ?>
  </div><!-- /caption -->
</div><!-- /image-caption-overlay -->


