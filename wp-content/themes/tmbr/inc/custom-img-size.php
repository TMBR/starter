<?php

if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'full_screen', 1680, 1000 ); // Ideal dimensions for load times on full width images
	add_image_size( 'xlarge', 1200, 1200 ); 

	add_image_size( 'lg_thumb', 700, 700, true ); // Force crop
	// add_image_size( 'headshot', 600, 450, array('center','top') ); > Set where image crops from
}