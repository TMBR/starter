<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

global $post;

$l_align = get_sub_field('ac_tc_2col_align_left');
$r_align = get_sub_field('ac_tc_2col_align_right');
$l_content = get_sub_field('ac_tc_left_text_2col');
$r_content = get_sub_field('ac_tc_right_text_2col');

?>


<div class="container">
  <div class="row">
    <div class="col-xs-6">
      <div class="content-wrap <?php if($l_align != 'left') { echo 'text-'. $l_align; } ?>">
        <?php echo $l_content; ?>
      </div><!-- /content-wrap -->
    </div><!-- /col -->
    <div class="col-xs-6">
      <div class="content-wrap <?php if($r_align != 'left') { echo 'text-'. $r_align; } ?>">
        <?php echo $r_content; ?>
      </div><!-- /content-wrap -->
    </div><!-- /col -->
  </div><!-- /row -->
</div><!-- /container-->