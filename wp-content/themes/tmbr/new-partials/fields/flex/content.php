<?php

$style = get_sub_field('cb_style');
$border = get_sub_field('cb_top_border');
$link = get_sub_field('cb_section_link');
$unique_id = get_sub_field('cb_section_id');
?>

<section class="content-block sec-padded <?php if($style == 'color') { echo 'bg-action'; } if($border){ echo 'top-border'; } ?>" <?php if($link){ echo 'id="'. $unique_id.'"'; } ?>>
  <div class="container-fluid stop1440">
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1 col-xs-12">
        <?php

          if( have_rows('cb_add_content') ) :

            while ( have_rows('cb_add_content') ) : the_row();

              if( get_row_layout() == 'cb_ac_text_content' ) {
                get_template_part( 'new-partials/fields/flex/content/text-content' );
              }

              elseif( get_row_layout() == 'cb_ac_header' ) {
                $tag = get_sub_field('ac_h_type');
                $align = get_sub_field('ac_h_align');
                $text = get_sub_field('ac_h_header_text');

                tmbr_load_template( 'partials/components/elements/header.php', array(
                  'tag' => (isset($tag)) ? $tag : null,
                  'align' => (isset($align)) ? $align : null,
                  'text' => (isset($text)) ? $text : null
                ));
              }

              elseif( get_row_layout() == 'cb_ac_button' ) {
                $type = get_sub_field('cbac_btn_type');
                $text = get_sub_field('cbac_btn_text');
                $site_pg = get_sub_field('cbac_site_page_link');
                $id = get_sub_field('cbac_section_name');
                $custom = get_sub_field('cbac_custom_link');
                $u_file = get_sub_field('cbac_upload_file');
                ?>
                <div class="text-center">
                <?php
                tmbr_load_template( 'partials/components/elements/button.php', array(
                  'type' => (isset($type)) ? $type : null,
                  'text' => (isset($text)) ? $text : null,
                  'site_pg' => (isset($site_pg)) ? $site_pg : null,
                  'id' => (isset($id)) ? $id : null,
                  'custom' => (isset($custom)) ? $custom : null,
                  'u_file' => (isset($u_file)) ? $u_file : null
                ));
                ?>
                </div>
                <?php
              }

            endwhile;

          endif;

        ?>

      </div><!-- /col -->
    </div><!-- /row -->
  </div><!-- /container -->
</section>