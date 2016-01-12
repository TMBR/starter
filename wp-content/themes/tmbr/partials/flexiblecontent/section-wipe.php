<?php
	$image = get_sub_field('wipe_image');
?>
<div class="container-fluid no-gutter sec-wipe" data-stellar-background-ratio="0.1" data-stellar-horizontal-offset="<?php echo get_sub_field('image_offset'); ?>" style="background-image : url('<?php echo $image['sizes']['hero-img']?>')">
</div><!-- /end background-wipe -->