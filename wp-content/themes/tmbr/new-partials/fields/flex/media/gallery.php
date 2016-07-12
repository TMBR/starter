<?php

$type = get_sub_field('fm_gallery_type');

if($type == 'image') {
  $img_gallery = get_sub_field('fm_image_gallery');
  tmbr_load_template( 'new-partials/components/media/img-gallery.php', array(
    'images' => (isset($img_gallery)) ? $img_gallery : null
  ));
}
elseif($type == 'video') {
  $rows = 'fm_video_gallery';
  $get_rows = get_sub_field($rows);

  tmbr_load_template( 'new-partials/components/media/video-gallery.php', array(
    'source' => 'flex_media',
    'rows' => (isset($rows)) ? $rows : null,
    'get_rows' => (isset($get_rows)) ? $get_rows : null
  ));
}