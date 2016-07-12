<?php

$style = get_sub_field('fm_style');
$border = get_sub_field('fm_top_border');
$link = get_sub_field('fm_section_link');
$unique_id = get_sub_field('fm_section_id');
?>

<section class="content-block sec-padded <?php if($style == 'color') { echo 'bg-action'; } if($border){ echo 'top-border'; } ?>" <?php if($link){ echo 'id="'. $unique_id.'"'; } ?>>
  <div class="container-fluid stop1440">
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1 col-xs-12">
        <?php

          if( have_rows('fm_add_content') ) :

            while ( have_rows('fm_add_content') ) : the_row();

              if( get_row_layout() == 'fm_media_items' ) {
                get_template_part( 'partials/custom-fields/flex/media/items' );
              }

              elseif( get_row_layout() == 'fm_gallery' ) {
                get_template_part( 'partials/custom-fields/flex/media/gallery' );
              }


              elseif( get_row_layout() == 'fm_ac_header' ) {
                $tag = get_sub_field('fm_h_type');
                $align = get_sub_field('fm_h_align');
                $text = get_sub_field('fm_h_header_text');

                tmbr_load_template( 'partials/components/elements/header.php', array(
                  'tag' => (isset($tag)) ? $tag : null,
                  'align' => (isset($align)) ? $align : null,
                  'text' => (isset($text)) ? $text : null
                ));
              }

            endwhile;

          endif;

        ?>

      </div><!-- /col -->
    </div><!-- /row -->
  </div><!-- /container -->
</section>