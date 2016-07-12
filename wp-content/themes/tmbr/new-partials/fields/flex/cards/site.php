<?php
$post_object = get_sub_field('lc_site_select');
$custom_header = get_sub_field('lc_site_custom_header');
$media_choice = get_sub_field('lc_custom_media_options');


if( $post_object ) :

  $post = $post_object;
  setup_postdata( $post );


  if($media_choice == 'none') {
    $add_media = 0;
  }
  else {
    $add_media = 1;
  }

  if($media_choice == 'page') {
    $source = 'site_hero';
  }
  elseif($media_choice == 'custom') {
    $source = 'site_custom';
  }

  $header = $custom_header ? $custom_header : get_the_title();
  $content = get_the_excerpt();
  $btn_text = 'Read More';
  $btn_link = get_the_permalink();

  tmbr_load_template( 'partials/components/cards/link-card.php', array(
    'source' => (isset($source)) ? $source : null,
    'header' => (isset($header)) ? $header : null,
    'add_media' => (isset($add_media)) ? $add_media : null,
    'content' => (isset($content)) ? $content : null,
    'btn_text' => (isset($btn_text)) ? $btn_text : null,
    'btn_link' => (isset($btn_link)) ? $btn_link : null
  ));
wp_reset_postdata();
endif;