<?php
/* Required vars:
* $l_align
* $r_align
* $l_content
* $r_content
*
* Used by:
* partials/fields/flex/content/text-content.php
*/

?>
<section class="layout -two-col ptb1">
  <div class="row">
    <div class="col-xs-6">
      <div class="content-wrap <?php if(isset($l_align)) {echo 'text-'.$l_align; } ?>">
        <?php if(!empty($l_content)){ echo $l_content; } ?>
      </div><!-- /block-wrap -->
    </div><!-- /col -->

    <div class="col-xs-6">
      <div class="content-wrap <?php if(isset($r_align)) {echo 'text-'.$r_align; } ?>">
        <?php if(!empty($r_content)){ echo $r_content; } ?>
      </div><!-- /block-wrap -->
    </div><!-- /col -->
  </div><!-- /row -->
</section><!-- /layout -->