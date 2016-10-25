<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

global $post;

/**
 *  ACF - Image Gallery (clone field)
 *
 *  Vars:
 *   $display - 'group', 'seamless'
 *   $label - for 'group' display only
 *
 *  Used by:
 *   partials/03_organism/get-flex-layouts.php
 */

/* Clone fields display type */
if(isset($display))
{

  if($display == 'group' && !empty($label)) {
    $header = $label['ig_header'];
    $images = $label['image_gallery'];
  }

  elseif($display == 'seamless') {
    $header = isset($header) ? $header : get_sub_field('ig_header');
    $images = isset($images) ? $images : get_sub_field('image_gallery');
  }

}

/* Assumes that field is getting loaded directly */
else
{
  $header = isset($header) ? $header : get_field('ig_header');
  $images = isset($images) ? $images : get_field('image_gallery');
}


// BEGIN MARKUP
if( $images ) :
?>



<section class="image-gallery">
  <?php if(isset($header)) { echo '<h2 class="title text-center">'. $header .'</h2>'; } ?>
  <div class="container-fluid stop1440">
    <div class="row">
      <?php foreach( $images as $image ): ?>
      <div class="col-md-2 col-xs-4">
        <a href="<?php echo $image['url']; ?>">
          <img src="<?php echo $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>" class="" />
        </a>
      </div><!-- /col -->
    <?php endforeach; ?>
    </div><!-- /row -->
  </div><!-- /container -->
</section>

<?php endif;
