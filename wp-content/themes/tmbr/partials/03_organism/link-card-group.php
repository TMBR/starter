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
 *
 *  Used by:
 *   partials/03_organism/get-flex-layouts.php
 */

/* Clone fields display type */
if(isset($display))
{

  if($display == 'group' && !empty($label)) {
    // this will likely not be the case
  }

  elseif($display == 'seamless') {
    $group_title = isset($group_title) ? $group_title : get_sub_field('link_group_header');
    $label1 = isset($label1) ? $label1 : get_sub_field('link_card1');
    $label2 = isset($label2) ? $label2 : get_sub_field('link_card2');
    $label3 = isset($label3) ? $label3 : get_sub_field('link_card3');
  }

}

/* Assumes that field is getting loaded directly */
else
{
  $group_title = isset($group_title) ? $group_title : get_field('link_group_header');
  $label1 = isset($label1) ? $label1 : get_field('link_card1');
  $label2 = isset($label2) ? $label2 : get_field('link_card2');
  $label3 = isset($label3) ? $label3 : get_field('link_card3');
}


?>



<section class="link-card-group">
  <?php if(isset($group_title)) { echo '<h2 class="title text-center">'. $group_title .'</h2>'; } ?>
  <div class="container-fluid stop1440">
    <div class="row">
      <div class="col-md-4 col-xs-12">
        <?php
        tmbr_load_template( 'partials/02_molecule/link-card.php', array(
          'display' => 'group',
          'label' => (isset($label1)) ? $label1 : null
        ));
        ?>
      </div><!-- /col -->
      <div class="col-md-4 col-xs-12">
        <?php
        tmbr_load_template( 'partials/02_molecule/link-card.php', array(
          'display' => 'group',
          'label' => (isset($label2)) ? $label2 : null
        ));
        ?>
      </div><!-- /col -->
      <div class="col-md-4 col-xs-12">
        <?php
        tmbr_load_template( 'partials/02_molecule/link-card.php', array(
          'display' => 'group',
          'label' => (isset($label3)) ? $label3 : null
        ));
        ?>
      </div><!-- /col -->
    </div><!-- /row -->
  </div><!-- /container -->
</section><!-- /link-card-group -->