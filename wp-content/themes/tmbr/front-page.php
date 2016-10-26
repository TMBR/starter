<?php
get_header();

	while ( have_posts() ) : the_post(); ?>



<main class="page-main" role="main">

	<?php
	// PAGE HERO
	get_template_part( 'partials/03_organism/page-hero' );

	// PAGE CONTENT
	get_template_part( 'partials/loops/page-content' );

	// FLEXIBLE CONTENT
	get_template_part( 'partials/03_organism/get-flex-layouts' ); ?>


</main>
<!-- #page-main -->



	<?php endwhile;

get_footer();
