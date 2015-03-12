<?php

if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'full_screen', 1680, 945, true ); //(cropped)
	add_image_size( 'mobile_full_screen', 1170, 658, true ); //(cropped)
}