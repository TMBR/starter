<div class="contest-50-50 container-fluid no-gutter white">
  <div class="row">

    <div class="col-xs-16 col-sm-16 col-md-16 col-lg-10">
    	<div class="sectioncopy">
			<h2 style="text-align: center;"><?php echo get_sub_field('sub_title'); ?></h2>
			<?php echo get_sub_field('contest_embed_script'); ?>
		</div>
	</div>

	<div class="col-lg-6 hidden-xs hidden-sm hidden-md">
		<?php $image = get_sub_field('right_image'); ?>
		<img src="<?php echo $image['url'] ?>" />
	</div>

  </div>
</div><!-- /end contest-50-50 -->