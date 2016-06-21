<?php

function btn_shortcode( $atts, $content = null ) {
	$a = shortcode_atts( array(
		'color' => '',
		'size' => '',
		'link' => '',
		'target' => 'self',
	), $atts );

	return '<a href="' . esc_attr($a['link']) . '" target="_' . esc_attr($a['target']) . '" class="btn btn-' . esc_attr($a['color']) . ' ' . esc_attr($a['size']) . '">' . $content . '</a>';
}

add_shortcode( 'button', 'btn_shortcode' );


/*
 * BOOSTRAP GRID SHORT CODES
 */


/// 1/2 COLUMN
	function one_half($atts, $content = null) {
		return '<div class="col-md-6">'.do_shortcode($content).'</div>';
	}
	add_shortcode ("one_half", "one_half");

/// 1/3 COLUMN
	function one_third($atts, $content = null) {
		return '<div class="col-sm-6 col-md-4">'.do_shortcode($content).'</div>';
	}
	add_shortcode ("one_third", "one_third");

/// 2/3 COLUMN
	function two_third($atts, $content = null) {
		return '<div class="col-sm-6 col-md-8">'.do_shortcode($content).'</div>';
	}
	add_shortcode ("two_third", "two_third");

/// 1/4 COLUMN
	function one_quarter($atts, $content = null) {
		return '<div class="col-sm-6 col-md-3">'.do_shortcode($content).'</div>';
	}
	add_shortcode ("one_quarter", "one_quarter");

/// 3/4 COLUMN
	function three_quarter($atts, $content = null) {
		return '<div class="col-sm-6 col-md-9">'.do_shortcode($content).'</div>';
	}
	add_shortcode ("three_quarter", "three_quarter");

