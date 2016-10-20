<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

global $post;


?>


<?php
	$image = get_sub_field('wipe_image');
?>
<div class="sec-wipe flex-section" data-stellar-background-ratio="0.1" data-stellar-horizontal-offset="<?php echo get_sub_field('image_offset'); ?>" style="background-image : url('<?php echo $image['sizes']['full_screen']?>')">
</div><!-- /end background-wipe -->