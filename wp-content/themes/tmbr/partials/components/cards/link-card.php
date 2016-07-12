<?php
/* Required vars:

* $source - this is required if add media = true ( so we know where to pull media from ) - options are: flex_custom / flex_site

* $header
* $add_media
* $content
* $btn_text
* $btn_link
*
* Used by:
* partials/fields/flex/cards/site.php
* partials/fields/flex/cards/custom.php
*/

?>

<div class="link-card">
  <?php
  if($add_media) {
    tmbr_load_template( 'partials/components/cards/media.php', array(
      'source' => (isset($source)) ? $source : null
    ));
  }
  if(isset($header)){ echo '<h4 class="title">'. $header .'</h4>'; }
  if(isset($content)){ echo '<p class="text">'. $content .'</p>'; }

  if($source == 'flex_custom') {
    $type = get_sub_field('lc_custom_btn_type');
    $text = get_sub_field('lc_custom_button_text');
    $site_pg = get_sub_field('lc_custom_site_page_link');
    $id = get_sub_field('lc_custom_section_name');
    $custom = get_sub_field('lc_custom_button_link');
    $u_file = get_sub_field('lc_custom_upload_file');

    tmbr_load_template( 'partials/components/elements/button.php', array(
      'type' => (isset($type)) ? $type : null,
      'text' => (isset($text)) ? $text : null,
      'site_pg' => (isset($site_pg)) ? $site_pg : null,
      'id' => (isset($id)) ? $id : null,
      'custom' => (isset($custom)) ? $custom : null,
      'u_file' => (isset($u_file)) ? $u_file : null
    ));
  }
  else {
    if(isset($btn_text)){ echo '<a href="'.$btn_link.'" class="btn">'. $btn_text .'</a>'; }
  }
  ?>
</div><!-- /link-card -->