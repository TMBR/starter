<?php

if(get_sub_field('add_link_cards')) :

  echo '<section class="card-row">';
    echo '<div class="row">';

    while(has_sub_field('add_link_cards')) :

      $type = get_sub_field('lc_type');

      echo '<div class="col-md-4 col-xs-12">';

        // CUSTOM CARD
        if($type == 'custom') {
          get_template_part( 'partials/custom-fields/flex/cards/custom' );
        }

        // SITE CONTENT
        elseif($type == 'site') {
          get_template_part( 'partials/custom-fields/flex/cards/site' );

        }


      echo '</div><!-- /col -->';

    endwhile;

    echo '</div><!-- /row -->';
  echo '</section><!-- /card-row -->';

endif;