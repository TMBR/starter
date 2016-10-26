<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}
global $post;


/**
 *  ACF - BUTTON (clone field)
 *  ===========================
 *  1. Checks if display is set to group or seamless
 *   a. if display = group, values are loaded as array
 *  2. Checks if variables to get_fields are set in load template,
 *  otherwise sets vars to base button fields
 *
 *  Vars:
 *   $display - 'group', 'seamless'
 *   $label - for 'group' display only
 *
 *  Used by:
 *   partials/02_molecule/link-card.php
 */


if(isset($display))
{

  if($display == 'group' && !empty($label)) {
    $btn_text = $label['btn_text'];
    $type = $label['btn_type'];
    $pg_link = $label['btn_pg_link'];
    $ext_url = $label['btn_url'];
    $file = $label['btn_file'];
    $sec_id = $label['btn_sec_id'];
  }

  elseif($display == 'seamless') {
    // could get very granular here and check if clone is sub field or not.
  }

}

/* Assumes that field is getting loaded directly */
else
{
  $btn_text = isset($btn_text) ? $btn_text : get_field('btn_text');
  $type = isset($type) ? $type : get_field('btn_type');

  $pg_link = isset($pg_link) ? $pg_link : get_field('btn_pg_link');
  $ext_url = isset($ext_url) ? $ext_url : get_field('btn_url');
  $file = isset($file) ? $file : get_field('btn_file');
  $sec_id = isset($sec_id) ? $sec_id : get_field('btn_sec_id');
}




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

// BEGIN MARKUP
echo '<a href="'. $href .'" '. ((isset($new_tab) && $new_tab == 'true') ? 'target="_blank" ' : '' ) .'class="btn">'. $btn_text .'</a>';




