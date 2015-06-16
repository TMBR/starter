// Email Modal Script
		  jQuery(function() {
			
			// Toggle the modal open - close
			function toggleEmailModal()
			{
				jQuery( ".overlay" ).fadeToggle( "slow", "linear" );
				jQuery( ".modal" ).fadeToggle( "slow", "linear" );
			}	  

			// If user has not completed the email form
			if (! jQuery.cookie('email-complete')) {

				// set page count if net set
				if (! jQuery.cookie('email-page')) {
					jQuery.cookie('email-page', '1', {  path: '/' } );
				} else {
					var value = parseFloat(jQuery.cookie('email-page'));
					value = value + 1;
					jQuery.cookie('email-page', value, {  path: '/' } );
				}
			
				// If the have viewed 3 pages and not closed the modal in 7 days
				if (jQuery.cookie('email-page') === '3' && !jQuery.cookie('close-email-page') ) {
					toggleEmailModal();
				}
				
				// listen if they close modal and set the cookie
				jQuery( ".overlay, .close-email" ).click(function() {
					toggleEmailModal()
					jQuery.cookie('close-email-page', 'true', { expires: 7, path: '/' } );
				});
				
				// Push event to analytics - Universal Analytics code
				//jQuery('#gform_1').on('submit', function() {
					//ga('send', 'event', 'Newsletter Sign Up', 'Submitted', 'All Pages And Pop up');
				//});
				//jQuery('#gform_2').on('submit', function() {
					//ga('send', 'event', 'Contact form', 'Submitted', 'Contact Page Info request');
				//});

				//jQuery('.nletter_signup').on('click', toggleEmailModal);

			}	
		});
