	<?php

	// If content in page editor - display standard content
	if( get_the_content() != '' && get_field('hide_main_content') === false ){
		// page intro
		get_template_part( 'partials/flexiblecontent/page-intro' );
	} ?>

	<?php

	// check if the flexible content field has rows of data
	if( have_rows('content') ):

	     // loop through the rows of data
	    while ( have_rows('content') ) : the_row();

	        if( get_row_layout() == 'contest' ):

	        	// Contest 50 / 50
				get_template_part( 'partials/flexiblecontent/contest-50-50' );

	        elseif( get_row_layout() == 'section_wipe' ):

				// Section Wipe
				get_template_part( 'partials/flexiblecontent/section-wipe' );

	        elseif( get_row_layout() == 'center_text' ):

				// Section Wipe
				get_template_part( 'partials/flexiblecontent/center-text' );

	        elseif( get_row_layout() == 'left-img-w-text' ):

				// left image w/ text
				get_template_part( 'partials/flexiblecontent/left-img-w-text' );


	        endif;

	    endwhile;

	else :

	    // no layouts found

	endif;

	?>