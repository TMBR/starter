
<footer>
	<div class="container">
		<div class="row">
			<div class="col-xs-6">
				<?php get_template_part( 'partials/global/schema' ); ?>
			</div><!-- /col -->
			<div class="col-xs-6"></div>
			<div class="col-xs-12">
				<p class="text-center copyright"><small><?php echo sprintf( __( '%1$s %2$s %3$s.'), 'Copyright &copy;', date('Y'), esc_html(get_bloginfo('name')) );  ?> All Rights Reserved. Site By
				<span class="sep"> | </span>
				<a href="http://wearetmbr.com/" rel="designer">TMBR</a></small></p>
			</div><!-- .site-info -->
		</div>
	</div>
</footer><!-- #colophon -->


<?php wp_footer(); ?>

</body>
</html>