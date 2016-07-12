<?php
/* Required vars:
* $img
* $content
*
* Used by:
* partials/fields/flex/content/text-content.php
*/
?>

<section class="layout -split -right ptb1">
  <div class="row">
    <div class="col-xs-6">
      <div class="content-wrap text-right">
        <?php if(!empty($content)){ echo $content; } ?>
      </div><!-- /img-wrap -->
    </div><!-- /col -->
    <div class="col-xs-6">
      <div class="img-wrap">
        <img src="<?php if(!empty($img)){ echo $img['sizes']['large']; } else { echo backup_img('large'); } ?>" class="img-responsive" />
      </div><!-- /img-wrap -->
    </div><!-- /col -->
  </div><!-- /row -->
</section><!-- /layout -->