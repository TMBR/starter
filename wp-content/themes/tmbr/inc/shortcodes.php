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