<div id="footer">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div id="copyright">
				<?php echo sprintf( __( '%1$s %2$s %3$s. All Rights Reserved.'), '&copy;', date('Y'), esc_html(get_bloginfo('name')) ); echo sprintf( __( ' Theme By: %1$s.' ), '<a href="http://wearetmbr.com/">TMBR</a>' ); ?>
				</div>
			</div><!-- /col -->
		</div><!-- /row -->
	</div><!-- /container -->
</div><!-- #footer -->

 </div> <!-- /end site container -->
</div> <!-- / end site wrapper -->

<?php if(is_production()) { ?>
<script src="<?php echo _s_revved_asset('js/vendor.min.js'); ?>"></script>
<script src="<?php echo _s_revved_asset('js/application.min.js'); ?>"></script>
<?php } else { ?>
<script src="<?php echo _s_asset('js/vendor.js'); ?>"></script>
<script src="<?php echo _s_asset('js/application.js'); ?>"></script>
<?php } ?>

<?php wp_footer(); ?>
<?php get_template_part('partials/action-modal'); ?>

</body>
</html>