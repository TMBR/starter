<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}
global $post;


/**
 *  ACF - BUTTON (clone field)
 *
 *  Checks if variables to get_fields are set in load template,
 *  otherwise sets vars to base button fields
 */

$btn_text = isset($btn_text) ? $btn_text : get_sub_field('btn_text');
$type = isset($type) ? $type : get_sub_field('btn_type'); // page / section / ext / file

$pg_link = isset($pg_link) ? $pg_link : get_sub_field('btn_pg_link');
$ext_url = isset($ext_url) ? $ext_url : get_sub_field('btn_url');
$file = isset($file) ? $file : get_sub_field('btn_file');
$sec_id = isset($sec_id) ? $sec_id : get_sub_field('btn_sec_id');


// Set button href based on button type
if( $type == 'page' ) {
  $href = $pg_link;
}
elseif( $type == 'section' ) {
  $href = $pg_link.'#'.$sec_id;
}
elseif( $type == 'ext' ) {
  $href = $ext_url;
  $new_tab = 'true';
}
elseif($type == 'file') {
  $href = $file;
  $new_tab = 'true';
}


echo '<a href="'. $href .'" '. ((isset($new_tab) && $new_tab == 'true') ? 'target="_blank" ' : '' ) .'class="btn">'. $btn_text .'</a>';




