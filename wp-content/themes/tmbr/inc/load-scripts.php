<?php

// Enqueue Scripts & Styles
// http://codex.wordpress.org/Function_Reference/wp_enqueue_script

function tmbr_load_scripts() {

	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/vendor/bootstrap/js/bootstrap.min.js',  array('jquery'), '', true );
	wp_enqueue_script( 'owlscript', get_template_directory_uri() . '/assets/vendor/owl/owl-carousel/owl.carousel.min.js',  array('jquery'), '', true );
	wp_enqueue_script( 'main', get_template_directory_uri() . '/assets/js/main.js',  array('jquery'), '', true );
	// wp_enqueue_script( 'typekit', '//use.typekit.net/xxxxxxx.js');

	wp_enqueue_style ( 'font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.css', array(), '', 'all' )	;
	wp_enqueue_style ( 'bootstrap', get_template_directory_uri() . '/assets/vendor/bootstrap/css/bootstrap.min.css', array(), '', 'all' )	;
	wp_enqueue_style ( 'owlslider', get_template_directory_uri() . '/assets/vendor/owl/owl-carousel/owl.carousel.css', array(), '', 'all' )	;
	wp_enqueue_style ( 'owltheme', get_template_directory_uri() . '/assets/vendor/owl/owl-carousel/owl.theme.css', array(), '', 'all' )	;

	wp_enqueue_style ( 'theme', get_stylesheet_uri(), array(), '', 'all' )	;

	}

add_action( 'wp_enqueue_scripts', 'tmbr_load_scripts' );



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
	<link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ); ?>/wp-content/themes/tmbr/css/ie.css" />
	<![endif]-->

<?php }

add_action( 'wp_head', 'cond_IE' );

?>