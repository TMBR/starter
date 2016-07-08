<?php
/* Required vars:
* $align
* $content
*
* Used by:
* partials/fields/flex/content/text-content.php
*/

?>
<section class="layout -default ptb1">
  <div class="row">
    <div class="col-xs-12">
      <div class="content-wrap <?php if(isset($align)) {echo 'text-'.$align; } ?>">
        <?php if(!empty($content)){ echo $content; } ?>
      </div><!-- /block-wrap -->
    </div><!-- /col -->
  </div><!-- /row -->
</section><!-- /layout -->