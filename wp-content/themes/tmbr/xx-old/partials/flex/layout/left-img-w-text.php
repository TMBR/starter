<?php
	$image = get_sub_field('left_image');
?>
<div class="flex-img-block -img-left flex-section">

  	<div class="img-wrapper no-gutter col-md-5">
  		<img class="img" src="<?php echo $image['sizes']['lg_thumb']?>" />
	</div>

    <div class="text-wrapper col-md-7">
		<h2 class="title"><?php echo get_sub_field('sub_title'); ?></h2>
		<p class="copy"><?php echo get_sub_field('copy'); ?></p>
		<?php if(get_sub_field('button_link')) { ?>
		<a class="btn" href="<?php echo get_sub_field('button_link'); ?>">
			<?php if(get_sub_field('button_text')) {
				echo get_sub_field('button_text');
			} else {
				echo "More";
			} ?>
		</a>
		<?php } ?>
	</div>
	<div class="clear"></div>
</div><!-- /end left image w text -->