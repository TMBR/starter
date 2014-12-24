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

	wp_deregister_script('jquery');
	wp_enqueue_script(
		'jquery',
		is_production()
			? _s_revved_asset('js/vendor.min.js')
			: _s_asset('js/vendor.js'),
		array(),
		'', // @TODO pull revved number from asset
		true
	);
	wp_enqueue_script(
		'application',
		is_production()
			? _s_revved_asset('js/application.min.js')
			: _s_asset('js/application.js'),
		array('jquery'),
		'', // @TODO pull revved number from asset
		true
	);
});

// TYPEKIT SCRIPT
function typekit_call() {

	if ( wp_script_is( 'typekit', 'done' ) ) { ?>
		<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
		<?php }
}

add_action( 'wp_head', 'typekit_call' );



// CONDITIONAL SCRIPTS
function cond_IE() { ?>

    <!--[if gte IE 6]>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie.css" />
	<![endif]-->

<?php }

add_action( 'wp_head', 'cond_IE' );

?>