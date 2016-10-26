<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

global $post;


$section_id = get_sub_field('cb_section_id');

?>


<section class="content-block" <?php if(isset($section_id)) { echo 'id="'. $section_id .'"'; } ?>>
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
  <?php

  // check if the flexible content field has rows of data
  if( have_rows('cb_add_content') ):

       // loop through the rows of data
      while ( have_rows('cb_add_content') ) : the_row();

          if( get_row_layout() == 'cb_ac_text_content' )   {
            //get_template_part( 'partials/03_organism/content-layout' );
            $layout = get_sub_field('ac_tc_layout');
            if($layout == 'default') {
              get_template_part( 'partials/03_organism/layout-full-col' );
            }
            elseif($layout == '2_col') {
              get_template_part( 'partials/03_organism/layout-2col' );
            }
            elseif($layout == '3_col') {
              get_template_part( 'partials/03_organism/layout-3col' );
            }
          }

          /**
           *  LINK CARD ROW
           *  clone field - requires passes in vars */
          elseif( get_row_layout() == 'cb_ac_header' )   {
            $header = get_sub_field('flex_ac_header');
            tmbr_load_template( 'partials/01_atom/text-header.php', array(
              'display' => 'group',
              'label' => (isset($header)) ? $header : null
            ));
          }

          /**
           *  LINK CARD ROW
           *  clone field - requires passes in vars */
          elseif( get_row_layout() == 'cb_ac_button' )   {
            $align = get_sub_field('flex_ac_btn_align');
            $button = get_sub_field('flex_ac_button');
            if($align != 'left') { echo '<div class="text-'. $align .'">'; }
            tmbr_load_template( 'partials/01_atom/button.php', array(
              'display' => 'group',
              'label' => (isset($button)) ? $button : null
            ));
            if($align != 'left') { echo '</div>'; }
          }

        endwhile;

        endif;

        ?>
    </div><!-- /col -->
  </div><!-- /row -->
</div><!-- /container-->
</section><!-- /content-block -->