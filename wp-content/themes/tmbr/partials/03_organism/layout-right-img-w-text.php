<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

global $post;

/**
 *  ACF - Right Image with Text
 *
 *  Vars:
 *   $display - 'group', 'seamless'
 *   $label - for 'group' display only
 *   $size - size of image
 *
 *  Dependent upon:
 *   partials/01_atom/button.php
 *
 *  Used by:
 *   partials/03_organism/get-flex-layouts.php
 */

/* Clone fields display type */
if(isset($display))
{

  if($display == 'group' && !empty($label)) {
    $img_obj = $label['iwt_image'];
    $header = $label['iwt_header'];
    $text = $label['iwt_text'];
    $button = $label['iwt_button'];
  }

  elseif($display == 'seamless') {
    $img_obj = isset($img_obj) ? $img_obj : get_sub_field('iwt_image');
    $header = isset($header) ? $header : get_sub_field('iwt_header');
    $text = isset($text) ? $text : get_sub_field('iwt_text');
    $button = isset($button) ? $button : get_sub_field('iwt_button');
  }

}

/* Assumes that field is getting loaded directly */
else
{
  $img_obj = isset($img_obj) ? $img_obj : get_field('iwt_image');
  $header = isset($header) ? $header : get_field('iwt_header');
  $text = isset($text) ? $text : get_field('iwt_text');
  $button = isset($button) ? $button : get_field('iwt_button');
}

$size = isset($size) ? $size : 'large';

$image = $img_obj['sizes'][$size];

?>

<section class="img-w-text right-iwt">
  <div class="container">
    <div class="row">
      <div class="col-sm-5 col-sm-push-7 col-xs-12">
        <img src="<?php if(!empty($image)) { echo $image; } else { echo backup_img($size); } ?>" alt="<?php echo $img_obj['alt']; ?>" class="img img-responsive" />
      </div><!-- /col -->
      <div class="col-sm-7 col-sm-pull-5 col-xs-12">
        <div class="content">
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
        </div><!-- /content -->
      </div><!-- /col -->
    </div><!-- /container -->
  </div><!-- /container -->
</section><!-- /img-w-text -->