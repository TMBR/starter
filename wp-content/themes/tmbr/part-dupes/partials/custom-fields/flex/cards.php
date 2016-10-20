<?php

$style = get_sub_field('lc_style');
$border = get_sub_field('lc_top_border');
$link = get_sub_field('lc_section_link');
$unique_id = get_sub_field('lc_section_id');
?>

<section class="content-block sec-padded <?php if($style == 'color') { echo 'bg-action'; } if($border){ echo 'top-border'; } ?>" <?php if($link){ echo 'id="'. $unique_id.'"'; } ?>>
  <div class="container-fluid stop1440">
    <div class="row">
      <div class="col-xs-12">
        <?php

          if( have_rows('lc_add_content') ) :

            while ( have_rows('lc_add_content') ) : the_row();

              if( get_row_layout() == 'link_card_row' ) {
                get_template_part( 'partials/custom-fields/flex/cards/row' );
              }

              elseif( get_row_layout() == 'lc_ac_header' ) {
                $tag = get_sub_field('lc_h_type');
                $align = get_sub_field('lc_h_align');
                $text = get_sub_field('lc_h_header_text');

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