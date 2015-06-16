
<div class="wrap">

	<div id="icon-options-general" class="icon32"></div>
	<h2>TMBR Roadblock Plugin Settings</h2>

	<div id="poststuff">

		<div id="post-body" class="metabox-holder columns-2">

			<!-- main content -->
			<div id="post-body-content">

				<div class="meta-box-sortables ui-sortable">


				
					<div class="postbox">

						<h3><span>Customize Modal Content</span></h3>

						<div class="inside">
							<form name="wptmbr_content_form" method="post" action="">

								<input type="hidden" name="wptmbr_form_submitted" value="Y">
								<table class="form-table">

									<tr>
										<td class="row-title"><label for="wptmbr_header">Form Header</label></td>
										<td><input name="wptmbr_header" id="wptmbr_header" type="text" value="<?php echo $wptmbr_header; ?>" class="regular-text" /></td>
									</tr>

									<tr>
										<td class="row-title"><label for="wptmbr_text">Form Text</label></td>
										<td><textarea name="wptmbr_text" id="wptmbr_text" cols="80" rows="10" ><?php echo $wptmbr_text; ?></textarea></td>
									</tr>

									<tr>
										<td class="row-title"><label for="wptmbr_gfid">Gravity Form ID</label></td>
										<td><input name="wptmbr_gfid" id="wptmbr_gfid" type="text" value="<?php echo $wptmbr_gfid; ?>" class="small-text" /></td>
									</tr>
									
								</table>
						
								<p><input class="button-primary" type="submit" name="wptmbr_form_submit" value="Update" /></p>
							</form>
						</div>
						<!-- .inside -->

					</div>
					<!-- .postbox -->
				
				</div>
				<!-- .meta-box-sortables .ui-sortable -->

			</div>
			<!-- post-body-content -->

			

		</div>
		<!-- #post-body .metabox-holder .columns-2 -->

		<br class="clear">
	</div>
	<!-- #poststuff -->

</div> <!-- .wrap -->




