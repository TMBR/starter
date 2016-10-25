<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

global $post;

/**
 *  ACF - Tab Content (clone field)
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



<section class="tab-content">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <ul class="nav nav-tabs" role="tablist">
        <?php
        $count = 0;
        foreach ($titlearray as $title) {
          $name = 'tab-' . $count;
          ?>

          <li role="presentation" class="<?php if($count == 0){ echo 'active' ;} ?>">
            <a href="#<?php echo $name; ?>" aria-controls="<?php echo $name; ?>" role="tab" data-toggle="tab">
              <?php echo $title ?>
            </a>
          </li>

        <?php $count++;
        }
        ?>
        </ul>

        <div class="tab-content">
        <?php
        $count = 0;
        foreach ($contentarray as $content) {
          $name = 'tab-' . $count;
          ?>

          <div role="tabpanel" class="tab-pane <?php if($count == 0){ echo 'active' ;} ?>" id="<?php echo $name; ?>">
            <?php echo $content; ?>
          </div>
        <?php $count++;
        }
        ?>
        </div><!-- /tab-content -->
      </div><!-- /col -->
    </div><!-- /row -->
  </div><!-- /container -->
</section>



