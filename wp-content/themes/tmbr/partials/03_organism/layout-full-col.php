<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

global $post;

$align = get_sub_field('ac_tc_default_align');
$content = get_sub_field('ac_tc_default_content');

?>

<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <div class="content-wrap <?php if($align != 'left') { echo 'text-'. $align; } ?>">
        <?php echo $content; ?>
      </div><!-- /content-wrap -->
    </div><!-- /col -->
  </div><!-- /row -->
</div><!-- /container-->