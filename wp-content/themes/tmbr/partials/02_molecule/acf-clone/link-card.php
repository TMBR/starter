<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

//global $post;

/**
 *  ACF - Link Card (clone field)
 *
 *  Checks whether link card type is set to page content or custom
 *    a. if type = page content, then variables are setup based on selected post object
 *    b. if type = custom, then vars are setup based on field values
 *  NOTE: This partial pulls in the button atom & resets the field values
 *
 *  Required vars:
 *   $feat_img
 *   $image
 *   $header
 *   $text
 *   ! button vars
 *
 *  Dependent upon:
 *   partials/01_atom/acf-clone/button.php
 */

$type = isset($type) ? $type : get_sub_field('link_card_type'); // content / custom


// IF LINK CARD = PAGE CONTENT, SET UP POST DATA
if($type == 'content') {
  $post_object = isset($post_object) ? $post_object : get_sub_field('link_card_content');

  if($post_object) {
    $post = $post_object;
    setup_postdata( $post );

    // set vars based on post
    $feat_img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium');
    $image = $feat_img['0'];
    $header = get_the_title();
    $text = get_the_excerpt();

    // vars required to load button partial:
    $href = get_the_permalink();
    $btn_text = 'Read More';

    wp_reset_postdata();
  }
}


// IF LINK CARD = CUSTOM
elseif($type == 'custom') {
  $img_obj = isset($img_obj) ? $img_obj : get_sub_field('link_card_image');
  $image = $img_obj['sizes']['medium'];
  $header = isset($header) ? $header : get_sub_field('link_card_header');
  $text = isset($text) ? $text : get_sub_field('link_card_text');

  // because button gets cloned as a group, this gets a little sticky
  $button = get_sub_field('link_card_button');
  $btn_text = $button['btn_text'];
  $type = $button['btn_type'];
  if( $type == 'page' ) { $href = $button['btn_pg_link']; }
  elseif( $type == 'section' ) { $href = $button['btn_pg_link'].'#'.$button['btn_sec_id']; }
  elseif( $type == 'ext' ) { $href = $button['btn_url']; }
  elseif($type == 'file') { $href = $button['btn_file']; }

}



// BEGIN MARKUP
?>

  <div class="link-card">

    <img src="<?php if(!empty($image)) { echo $image; } else { echo backup_img('medium'); } ?>" class="img-responsive img" alt="<?php echo $header; ?>" />

    <?php
    if(isset($header)){
      echo '<h4 class="title">'. $header .'</h4>';
    }

    if(isset($text)){
      echo '<p class="text">'. $text .'</p>';
    }

    tmbr_load_template( 'partials/01_atom/acf-button.php', array(
      'href' => (isset($href)) ? $href : null,
      'btn_text' => (isset($btn_text)) ? $btn_text : null,
      'new_tab' => (isset($new_tab)) ? $new_tab : null
    ));
    ?>

  </div><!-- /link-card -->

