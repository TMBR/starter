<?php
add_action('wp_enqueue_scripts', function(){
	wp_enqueue_style(
		'application',
		is_production()
			? _s_revved_asset('css/application.min.css')
			: _s_asset('css/application.css'),
		array(),
		'' // @TODO pull revved number
	);

	$in_footer = true;
	wp_deregister_script('jquery');
	wp_enqueue_script(
		'jquery',
		is_production()
			? _s_revved_asset('js/vendor.min.js')
			: _s_asset('js/vendor.js'),
		array(),
		'', // @TODO pull revved number from asset
		!$in_footer
	);
	wp_enqueue_script(
		'application',
		is_production()
			? _s_revved_asset('js/application.min.js')
			: _s_asset('js/application.js'),
		array('jquery'),
		'', // @TODO pull revved number from asset
		$in_footer
	);
});


// CONDITIONAL SCRIPTS
function cond_IE() { ?>

    <!--[if gte IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie.css" />
	<![endif]-->

<?php }

add_action( 'wp_head', 'cond_IE' );