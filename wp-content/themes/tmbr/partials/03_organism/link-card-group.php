<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

global $post;

/**
 *  ACF - Link Card Group (clone field)
 *
 *  NOTE: This partial pulls in the link card molecule & resets the field values
 *
 *  Dependent upon:
 *   partials/02_molecule/link-card.php
 */


$group_title = isset($group_title) ? $group_title : get_field('link_group_header');
?>



<section class="link-card-group">
  <?php if(isset($group_title)) { echo '<h2 class="title text-center">'. $group_title .'</h2>'; } ?>
  <div class="container-fluid stop1440">
    <div class="row">
      <div class="col-md-4 col-xs-12">
        <?php
        $label = get_field('link_card1');
        tmbr_load_template( 'partials/02_molecule/link-card.php', array(
          'display' => 'group',
          'label' => (isset($label)) ? $label : null
        ));
        ?>
      </div><!-- /col -->
      <div class="col-md-4 col-xs-12">
        <?php
        $label = get_field('link_card2');
        tmbr_load_template( 'partials/02_molecule/link-card.php', array(
          'display' => 'group',
          'label' => (isset($label)) ? $label : null
        ));
        ?>
      </div><!-- /col -->
      <div class="col-md-4 col-xs-12">
        <?php
        $label = get_field('link_card3');
        tmbr_load_template( 'partials/02_molecule/link-card.php', array(
          'display' => 'group',
          'label' => (isset($label)) ? $label : null
        ));
        ?>
      </div><!-- /col -->
    </div><!-- /row -->
  </div><!-- /container -->
</section><!-- /link-card-group -->