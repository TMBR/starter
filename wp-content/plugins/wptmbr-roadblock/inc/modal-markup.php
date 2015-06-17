
<?php 
if( !function_exists('gravity_form') ) {  
	return; 
} 
?>

<div class="overlay"></div>

<div id="newsletter_signup" class="modal">

	<div class="modal-dialog" role="document">

		<div class="modal-content">


			<div class="modal-header">

				<button type="button" class="close close-email">&times;</button>
				<h3 class="modal-title"><?php echo esc_html($wptmbr_header); ?></h3>

			</div><!-- /modal-header -->


			<div class="modal-body">

				<p><?php echo esc_html($wptmbr_text); ?></p>
				<?php gravity_form( intval($wptmbr_gfid), false, false, false, '', true); ?>

			</div><!-- /modal-body -->


			<div class="modal-footer">

				<p class="close-email text-center">&times; No Thanks</p>

			</div><!-- /modal-footer -->


		</div><!-- /modal-content -->
		
	</div><!-- /modal-dialog -->

</div>  <!-- #newsletter_signup -->
