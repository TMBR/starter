<?php
	$image = get_sub_field('left_image');
?>
<div class="flex-content img-block img-left container-fluid no-gutter white">
  <div class="row animated-row">
  	<div class="col-md-6 hidden-xs hidden-sm centered-row">
  		<img src="<?php echo $image['sizes']['news-img']?>" class="fullwidth wow fadeIn" data-wow-delay=".3s" />
	</div>
    <div class="col-xs-16 col-sm-16 col-md-10 centered-row">
    	<div class="sectioncopy-right centered-copy">
			<h2><?php echo get_sub_field('sub_title'); ?></h2>
			<p><?php echo get_sub_field('copy'); ?></p>
			<?php if(get_sub_field('button_link')) { ?>
			<a class="gform_button button" style="margin-top : 20px;" href="<?php echo get_sub_field('button_link'); ?>" target="_blank">
				<?php if(get_sub_field('button_text')) {
					echo get_sub_field('button_text');
				} else {
					echo "Learn More";
				} ?>
			</a>
			<?php } ?>
		</div>
	</div>
	</div>
  </div>
</div><!-- /end left image w text -->