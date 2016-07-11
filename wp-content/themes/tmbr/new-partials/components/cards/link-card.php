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
    tmbr_load_template( 'new-partials/components/cards/media.php', array(
      'source' => (isset($source)) ? $source : null
    ));
  }
  if(isset($header)){ echo '<h4 class="title">'. $header .'</h4>'; }
  if(isset($content)){ echo '<p class="text">'. $content .'</p>'; }
  if(isset($btn_text)){ echo '<a href="'.$btn_link.'" class="btn">'. $btn_text .'</a>'; }
  ?>
</div><!-- /link-card -->