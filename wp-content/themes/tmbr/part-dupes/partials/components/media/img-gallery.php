<?php
/* Required vars:

* $images
*
* Used by:
* partials/fields/flex/media/gallery.php

*/


if($images) :
?>
<section class="gallery -img js-flex-gallery-img pb4">
  <div class="row">
    <?php foreach( $images as $image ) : ?>
    <div class="col-lg-2 col-sm-3 col-xs-4">
      <a href="<?php echo $image['sizes']['large']; ?>">
        <img src="<?php echo $image['sizes']['medium']; ?>" alt="" class="img-responsive" />
      </a>
    </div><!-- /col -->
    <?php endforeach; ?>
  </div><!-- /row -->
</section><!-- /img-gallery -->
<?php endif; ?>