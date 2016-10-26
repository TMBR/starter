
<footer class="footer ptb3" role="contentinfo" itemscope="itemscope" itemtype="http://schema.org/WPFooter">
	<div class="container-fluid stop1170">
		<div class="row">
			<div class="col-md-10 col-md-offset-1 col-xs-12">

				<div class="row">
					<div class="col-sm-3 col-xs-12">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 1') ) { ?>
							<h5 class="list-title">Articles by month</h5>
							<ul class="menu">
								<?php wp_get_archives('title_li=&type=monthly'); ?>
							</ul>
						<?php } ?>
					</div><!-- /col -->

					<div class="col-sm-3 col-xs-12">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 2') ) { ?>
							<h5 class="list-title">Categories</h5>
							<ul class="menu">
								<?php wp_list_categories('show_count=0&title_li='); ?>
							</ul>
						<?php } ?>
					</div><!-- /col -->

					<div class="col-sm-3 col-xs-12">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 3') ) { ?>
							<h5 class="list-title">Pages</h5>
							<ul class="menu">
								<?php wp_list_pages('title_li='); ?>
							</ul>
						<?php } ?>
					</div><!-- /col -->

					<div class="col-sm-3 col-xs-12">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 4') ) { ?>
							<h5 class="list-title">Categories</h5>
							<ul class="menu">
								<?php wp_list_categories('show_count=0&title_li='); ?>
							</ul>
						<?php } ?>
					</div><!-- /col -->
				</div><!-- /row -->
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<?php get_template_part('partials/02_molecule/social-bar'); ?>
				<p class="copyright mb4">
					<?php echo sprintf( __( '%1$s %2$s %3$s.'), 'Copyright &copy;', date('Y'), esc_html(get_bloginfo('name')) );  ?> All Rights Reserved. Site by <a href="" target="_blank">TMBR</a>.
				</p>
			</div><!-- /col -->
		</div><!-- /row -->

	</div><!-- /container -->
</footer><!-- footer -->

</div><!-- .body -->

<?php wp_footer(); ?>

</body>
</html>