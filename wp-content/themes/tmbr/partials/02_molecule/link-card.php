<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

global $post;

/**
 *  ACF - Link Card (clone field)
 *  ==============================
 *  1. Checks if display is set to group or seamless
 *   a. if display = group, values are loaded as array
 *  2. Checks whether link card type is set to page content or custom
 *    a. if type = page content, then variables are setup based on selected post object
 *    b. if type = custom, then vars are setup based on field values
 *
 *  Vars:
 *   $display - 'group', 'seamless'
 *   $label - for 'group' display only
 *
 *  Dependent upon:
 *   partials/01_atom/button.php
 *
 *  Used by:
 *   partials/03_organism/link-card-group.php
 */



/* Clone fields display type */
if(isset($display))
{

  if($display == 'group' && !empty($label)) {
    $type = $label['link_card_type'];
    $post_object = $label['link_card_content'];
    $img_obj = $label['link_card_image'];
    $header = $label['link_card_header'];
    $text = $label['link_card_text'];
    $button = $label['link_card_button'];

  }

  elseif($display == 'seamless') {
    // could get very granular here and check if clone is sub field or not.
  }

}

/* Assumes that field is getting loaded directly */
else
{
  $type = isset($type) ? $type : get_field('link_card_type');
  $post_object = isset($post_object) ? $post_object : get_field('link_card_content');
  $img_obj = isset($img_obj) ? $img_obj : get_field('link_card_image');
  $header = isset($header) ? $header : get_field('link_card_header');
  $text = isset($text) ? $text : get_field('link_card_text');
  $button = isset($button) ? $button : get_field('link_card_button');
}



if($type == 'content') {

  /* set up post data */
  if($post_object) {
    $post = $post_object;
    setup_postdata( $post );

    // set vars based on post
    $feat_img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium');
    $image = $feat_img['0'];
    $header = $post->post_title;
    $text = get_the_excerpt();

    // vars required to load button partial:
    $href = get_the_permalink();

    wp_reset_postdata();

  }
}


elseif($type == 'custom') {

  $image = $img_obj['sizes']['medium'];

}


?>

  <div class="link-card">
    <img src="<?php if(!empty($image)) { echo $image; } else { echo backup_img('medium'); } ?>" class="img-responsive img" alt="<?php echo $header; ?>" />

    <?php
    if(isset($header)) {
      echo '<h4 class="title">'. $header .'</h4>';
    }

    if(isset($text)) {
      echo '<p class="text">'. $text .'</p>';
    }


    if($type == 'custom') {
      tmbr_load_template( 'partials/01_atom/button.php', array(
        'display' => 'group',
        'label' => (isset($button)) ? $button : null
      ));
    } else {
      echo '<a href="'. $href .'" class="btn">Read More</a>';
    }
    ?>
  </div><!-- /link-card -->

