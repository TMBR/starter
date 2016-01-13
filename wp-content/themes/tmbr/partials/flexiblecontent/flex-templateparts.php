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

	        if( get_row_layout() == 'section_wipe' ):
				// Section Wipe
				get_template_part( 'partials/flexiblecontent/section-wipe' );

	        elseif( get_row_layout() == 'center_text' ):
				// center text
				get_template_part( 'partials/flexiblecontent/center-text' );

	        elseif( get_row_layout() == 'left-img-w-text' ):
				// left image w/ text
				get_template_part( 'partials/flexiblecontent/left-img-w-text' );

	        elseif( get_row_layout() == 'right-img-w-text' ):
				// right image w/ text
				get_template_part( 'partials/flexiblecontent/right-img-w-text' );

	        elseif( get_row_layout() == 'image_gallery' ):
				// img gallery
				get_template_part( 'partials/flexiblecontent/img-gallery' );

	        endif;

	    endwhile;

	else :

	    // no layouts found

	endif;

	?>