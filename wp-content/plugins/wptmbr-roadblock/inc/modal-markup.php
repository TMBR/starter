
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
				<h3 class="modal-title pre-confirm"><?php echo esc_html($wptmbr_header); ?></h3>
				<h3 class="modal-title post-confirm">Success!</h3>
			</div><!-- /modal-header -->


			<div class="modal-body">

				<p class="pre-confirm"><?php echo esc_html($wptmbr_text); ?></p>
				<?php gravity_form( intval($wptmbr_gfid), false, false, false, '', true); ?>

			</div><!-- /modal-body -->


			<div class="modal-footer">

				<p class="close-email text-center pre-confirm">&times; No Thanks</p>
				<p class="close-email text-center post-confirm">&times; Close</p>

			</div><!-- /modal-footer -->


		</div><!-- /modal-content -->
		
	</div><!-- /modal-dialog -->

</div>  <!-- #newsletter_signup -->

<script type="text/javascript">

//Add class to #newsletter_signup once Gravity Forms confirmation is loaded

jQuery(document).ready(function(){
	jQuery(document).bind('gform_confirmation_loaded', function(event, form_id){
		jQuery('#newsletter_signup').addClass('roadblock-confirm');
	});
});

</script>