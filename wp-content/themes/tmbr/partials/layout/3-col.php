<?php
/* Required vars:
* $l_content
* $c_content
* $r_content
*
* Used by:
* partials/fields/flex/content/text-content.php
*/

?>
<section class="layout -two-col ptb1">
  <div class="row">
    <div class="col-xs-4">
      <div class="content-wrap">
        <?php if(!empty($l_content)){ echo $l_content; } ?>
      </div><!-- /block-wrap -->
    </div><!-- /col -->

    <div class="col-xs-4">
      <div class="content-wrap">
        <?php if(!empty($c_content)){ echo $c_content; } ?>
      </div><!-- /block-wrap -->
    </div><!-- /col -->

    <div class="col-xs-4">
      <div class="content-wrap">
        <?php if(!empty($r_content)){ echo $r_content; } ?>
      </div><!-- /block-wrap -->
    </div><!-- /col -->
  </div><!-- /row -->
</section><!-- /layout -->