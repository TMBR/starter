<?php

// Theme Setup & Support
// http://codex.wordpress.org/Function_Reference/add_theme_support

add_action('after_setup_theme', 'tmbr_setup');

function tmbr_setup() {

	add_theme_support('automatic-feed-links');
	add_theme_support('post-thumbnails');

	}

// ADD TMBR LOGO TO LOGIN PAGE
	add_action('login_head', 'tmbr_login_head');
	function tmbr_login_head() {
		echo "
		<style>
		body.login #login h1 a {
			background: url('".get_bloginfo('template_url')."/assets/img/tmbr-logo.png') no-repeat scroll center top transparent;
			height: 160px;
			width: 140px;
			margin: 0 auto;
		}
		</style>
		";
}
?>