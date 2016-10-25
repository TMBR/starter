<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

global $post;

/**
 *  ACF - Panel Content (clone field)
 *
 *  Vars:
 *   $display - 'group', 'seamless'
 *   $label - for 'group' display only
 *
 *  Used by:
 *   partials/03_organism/get-flex-layouts.php
 */

$titlearray = array();
$contentarray = array();
$accordionID = rand(5, 20);

/* Clone fields display type */
if(isset($display))
{

  if($display == 'group' && !empty($label)) {
    $sections = $label['tp_content'];
  }

  elseif($display == 'seamless') {
    $sections = isset($sections) ? $sections : get_sub_field('tp_content');
  }

}

/* Assumes that field is getting loaded directly */
else
{
  $sections = isset($sections) ? $sections : get_field('tp_content');
}

// BEGIN MARKUP
if( $sections ) :
  foreach( $sections as $section ) :

    // Build arrays of content to traverse later
    $titlearray[] = $section['section_title'];
    $contentarray[] = $section['section_content'];

  endforeach;
endif;
?>



<section class="panel-content">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="panel-group" class="accordion" role="tablist" aria-multiselectable="true">
        <?php
        $count = 0;
        foreach ($titlearray as $title) {
          $collapse = 'collapse-' . $count . '-' . $accordionID;
          $heading = 'heading-' . $count . '-' . $accordionID;
          ?>

          <div class="panel panel-default">

            <div class="panel-heading" role="tab" id="<?php echo $heading ; ?>">
              <h4 class="panel-title">
                <a class="<?php if($count != 0){ echo 'collapsed' ;} ?>" role="button" data-toggle="collapse" data-parent="<?php echo '#accordion-' . $accordionID; ?>" href="#<?php echo $collapse ; ?>" aria-expanded="<?php if($count == 0){ echo 'true' ;} else { echo 'false' ;} ?>" aria-controls="<?php echo $collapse ; ?>">
                  <?php echo $title ; ?>
                </a>
              </h4>
            </div><!-- /panel-heading -->

            <div id="<?php echo $collapse ; ?>" class="panel-collapse collapse <?php if($count == 0){ echo 'in' ;} ?>" role="tabpanel" aria-labelledby="<?php echo $heading ; ?>">
              <div class="panel-body">
                <?php echo $contentarray[$count] ; ?>
              </div><!-- /panel-body -->
            </div><!-- /panel-collapse -->

          </div><!-- /panel -->

          <?php $count++;
          } ?>
        </div><!-- /panel-group -->
      </div><!-- /col -->
    </div><!-- /row -->
  </div><!-- /container -->
</section>



