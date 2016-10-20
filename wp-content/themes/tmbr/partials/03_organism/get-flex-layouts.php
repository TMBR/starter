<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

global $post;

  // If content in page editor - display standard content
  if( get_the_content() != '' && get_field('hide_main_content') == false ){
    // page intro
    get_template_part( 'partials/loops/page-content' );
  } ?>

  <?php

  // check if the flexible content field has rows of data
  if( have_rows('flex_content') ):

       // loop through the rows of data
      while ( have_rows('flex_content') ) : the_row();

          if( get_row_layout() == 'content_block' )   {
            get_template_part( 'partials/03_organism/content-block' );
          }

          /**
           *  LINK CARD ROW
           *  clone field - requires passes in vars */
          elseif( get_row_layout() == 'link_card_row' )   {
            tmbr_load_template( 'partials/03_organism/link-card-group.php', array(
              'display' => 'seamless'
            ));
          }

          /**
           *  MEDIA GALLERY
           *  loads template based on "gallery type" */
          elseif( get_row_layout() == 'media_gallery' )   {
            if( get_sub_field('mg_gallery_type') == 'image' ) {
              $label = get_sub_field('mg_img');
              tmbr_load_template( 'partials/03_organism/image-gallery.php', array(
                'display' => 'group',
                'label' => (isset($label)) ? $label : null
              ));
            }
            elseif( get_sub_field('mg_gallery_type') == 'video' ) {
              $label = get_sub_field('mg_video');
              tmbr_load_template( 'partials/03_organism/video-gallery.php', array(
                'display' => 'group',
                'label' => (isset($label)) ? $label : null
              ));
            }
          }

          /**
           *  MEDIA SLIDER
           *  clone field - requires passes in vars */
          elseif( get_row_layout() == 'media_slider' )  {
            tmbr_load_template( 'partials/03_organism/media-slider.php', array(
              'display' => 'seamless'
            ));
          }

          /**
           *  IMAGE WITH TEXT
           *  clone field - requires passes in vars
           *  loads template based on "layout" */
          elseif( get_row_layout() == 'image_with_text' )   {
            if( get_sub_field('iwt_layout') == 'left_iwc' ) {
              tmbr_load_template( 'partials/03_organism/left-img-w-text.php', array(
                'display' => 'seamless'
              ));
            }
            elseif( get_sub_field('iwt_layout') == 'right_iwc' ) {
              tmbr_load_template( 'partials/03_organism/right-img-w-text.php', array(
                'display' => 'seamless'
              ));
            }
          }


          elseif( get_row_layout() == 'tabbed_content' )  { get_template_part( 'partials/03_organism/content-blockx' ); }



      endwhile;

  else :

      // no layouts found

  endif;

  ?>
