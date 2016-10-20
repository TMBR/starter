<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

global $post;

$l_content = get_sub_field('ac_tc_left_text_3col');
$r_content = get_sub_field('ac_tc_right_text_3col');
$c_content = get_sub_field('ac_tc_center_text_3col');

?>


<div class="container">
  <div class="row">
    <div class="col-xs-4">
      <div class="content-wrap">
        <?php echo $l_content; ?>
      </div><!-- /content-wrap -->
    </div><!-- /col -->
    <div class="col-xs-4">
      <div class="content-wrap">
        <?php echo $c_content; ?>
      </div><!-- /content-wrap -->
    </div><!-- /col -->
    <div class="col-xs-4">
      <div class="content-wrap">
        <?php echo $r_content; ?>
      </div><!-- /content-wrap -->
    </div><!-- /col -->
  </div><!-- /row -->
</div><!-- /container-->