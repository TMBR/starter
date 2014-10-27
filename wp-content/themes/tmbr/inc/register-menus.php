<?php

// Registers Menus
// http://codex.wordpress.org/Function_Reference/register_nav_menus

function register_my_menus() {
	register_nav_menus(
		array(
			'main-menu' => __( 'Main Menu' ), // Don't change this menu's slug if you want the dropdown menu to work.
			'footer-menu' => __( 'Footer Menu' ),
		)
	);
	}

add_action( 'init', 'register_my_menus' );
?>