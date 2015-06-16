<div class="overlay"></div>
  <div id="newsletter_signup" class="modal">
	  <div class="popup-bg"></div> 
	  <h3>E-mail Newsletter Sign Up</h3>
	  <?php $options = get_option( 'wptmbr_roadblock'); print_r($options);?>
	  	<div id="email-signup">
	  	<p style="margin-bottom: 0;">Receive early notification of packages, last minute deals and upcoming events.</p>
	  	<?php //echo do_shortcode('[gravityform id='. $wptmbr_gfid.' title=false description=false ajax=true]'); ?>
	  	<?php $test = '[gravityform id='. $wptmbr_gfid.' title=false description=false ajax=true]';
	  	echo $test; ?>
		  	<div class="clear"></div>
		  	<p class="close-email">&times; Close Window</p>
		</div>
  </div>