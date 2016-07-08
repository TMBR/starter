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

              if( get_row_layout() == 'cb_ac_text_content' ) { get_template_part( 'new-partials/fields/flex/content/text-content' ); }

              elseif( get_row_layout() == 'cb_ac_header' ) { get_template_part( 'new-partials/fields/flex/content/header' ); }

              elseif( get_row_layout() == 'cb_ac_button' ) { get_template_part( 'new-partials/fields/flex/cards' ); }

              elseif( get_row_layout() == 'cb_ac_form' ) { get_template_part( 'new-partials/fields/flex/media' ); }

            endwhile;

          endif;

        ?>

      </div><!-- /col -->
    </div><!-- /row -->
  </div><!-- /container -->
</section>