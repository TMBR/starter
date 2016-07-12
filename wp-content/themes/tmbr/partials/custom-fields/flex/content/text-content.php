<?php

$layout = get_sub_field('ac_tc_layout');


/* DEFAULT LAYOUT */
if($layout == 'default') {

  $align = get_sub_field('ac_tc_default_align');
  $content_1col = get_sub_field('ac_tc_default_content');

  tmbr_load_template( 'partials/layout/default.php', array(
    'align' => (isset($align)) ? $align : null,
    'content' => (isset($content_1col)) ? $content_1col : null
  ));
}



/* SPLIT LAYOUT */
elseif($layout == 'text_img') {

  $img_align = get_sub_field('ac_tc_image_align');
  $img_split = get_sub_field('ac_tc_image_split');
  $left_text = get_sub_field('ac_tc_left_text_split');
  $right_text = get_sub_field('ac_tc_right_text_split');

  if($img_align == 'left_img') {
    tmbr_load_template( 'partials/layout/left-img.php', array(
      'img' => (isset($img_split)) ? $img_split : null,
      'content' => (isset($right_text)) ? $right_text : null
    ));
  }
  elseif($img_align == 'right_img') {
    tmbr_load_template( 'partials/layout/right-img.php', array(
      'img' => (isset($img_split)) ? $img_split : null,
      'content' => (isset($left_text)) ? $left_text : null
    ));
  }
}




/* TWO COL LAYOUT */
elseif($layout == '2_col') {

  $l_align_2 = get_sub_field('ac_tc_2col_align_left');
  $r_align_2 = get_sub_field('ac_tc_2col_align_right');
  $left_text = get_sub_field('ac_tc_left_text_split');
  $right_text = get_sub_field('ac_tc_right_text_split');

  tmbr_load_template( 'partials/layout/2-col.php', array(
    'l_align' => (isset($l_align_2)) ? $l_align_2 : null,
    'r_align' => (isset($r_align_2)) ? $r_align_2 : null,
    'l_content' => (isset($left_text)) ? $left_text : null,
    'r_content' => (isset($right_text)) ? $right_text : null
  ));
}




/* THREE COL LAYOUT */
elseif($layout == '3_col') {

  $left_text_3 = get_sub_field('ac_tc_left_text_3col');
  $center_text_3 = get_sub_field('ac_tc_center_text_3col');
  $right_text_3= get_sub_field('ac_tc_right_text_3col');

  tmbr_load_template( 'partials/layout/3-col.php', array(
    'l_content' => (isset($left_text_3)) ? $left_text_3 : null,
    'c_content' => (isset($center_text_3)) ? $center_text_3 : null,
    'r_content' => (isset($right_text_3)) ? $right_text_3 : null
  ));
}


?>

