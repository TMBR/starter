  <?php

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

          if( get_row_layout() == 'content_block' )   { get_template_part( 'partials/03_organism/content-blockx' ); }

          /**
           *  LINK CARD ROW
           *  clone field - requires passes in vars */
          if( get_row_layout() == 'link_card_row' )   {
            tmbr_load_template( 'partials/03_organism/link-card-group.php', array(
              'display' => 'seamless'
            ));
          }

          /**
           *  MEDIA GALLERY
           *  loads template based on "gallery type" */
          if( get_row_layout() == 'media_gallery' )   {
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


          if( get_row_layout() == 'media_slider' )  { get_template_part( 'partials/03_organism/content-blockx' ); }

          if( get_row_layout() == 'left_img_w_text' )   { get_template_part( 'partials/03_organism/content-blockx' ); }

          if( get_row_layout() == 'right_img_w_text' )  { get_template_part( 'partials/03_organism/content-blockx' ); }

          if( get_row_layout() == 'tabbed_content' )  { get_template_part( 'partials/03_organism/content-blockx' ); }



      endwhile;

  else :

      // no layouts found

  endif;

  ?>
