<?php
/**
 * The sidebar containing the main widget area.
 *
 */
?>

<div class="col-sm-4">
	<div id="secondary" class="widget-area" role="complementary">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Page Sidebar') ) { ?>

			<li class="widget">
				<?php get_search_form(); ?>
			</li>

			<li class="widget">
				<ul class="menu">
					<h4 class="list-title">Pages</h4>
					<?php wp_list_pages('title_li='); ?>
				</ul>
			</li>

			<li class="widget">
				<ul class="menu">
					<h4 class="list-title">Categories</h4>
			        <?php wp_list_categories('show_count=0&title_li='); ?>
				</ul>
			</li>

			<li class="widget">
				<ul class="menu">
					<h4 class="list-title">Articles by month</h4>
			        <?php wp_get_archives('title_li=&type=monthly'); ?>
				</ul>
			</li>

		<?php } ?>
	</div><!-- #secondary -->
</div>
