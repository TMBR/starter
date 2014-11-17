<?php

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