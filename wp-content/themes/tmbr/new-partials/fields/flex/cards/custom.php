<?php

$header = get_sub_field('lc_custom_header');
$add_media = get_sub_field('lc_custom_add_media');
$content = get_sub_field('lc_custom_content_excerpt');
$btn_text = get_sub_field('lc_custom_button_text');
$btn_link = get_sub_field('lc_custom_button_link');


tmbr_load_template( 'new-partials/components/cards/link-card.php', array(
  'source' => 'flex_custom',
  'header' => (isset($header)) ? $header : null,
  'add_media' => (isset($add_media)) ? $add_media : null,
  'content' => (isset($content)) ? $content : null,
  'btn_text' => (isset($btn_text)) ? $btn_text : null,
  'btn_link' => (isset($btn_link)) ? $btn_link : null
));