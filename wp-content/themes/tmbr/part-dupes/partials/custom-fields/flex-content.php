<section class="flex-content">

<?php

  if( have_rows('flex_content') ) :

    while ( have_rows('flex_content') ) : the_row();

      if( get_row_layout() == 'content_block' ) { get_template_part( 'partials/custom-fields/flex/content' ); }

      elseif( get_row_layout() == 'link_cards' ) { get_template_part( 'partials/custom-fields/flex/cards' ); }

      elseif( get_row_layout() == 'flex_media' ) { get_template_part( 'partials/custom-fields/flex/media' ); }

    endwhile;

  endif;

?>
</section>