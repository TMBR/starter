<?php
/**
 * The template used for displaying page content in page.php
 *
 *
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 itemprop="headline" class="entry-title animation" data-animation="animation-fade-in-down">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div itemprop="text" class="entry-content animation" data-animation="animation-fade-in-up">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', '_s' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php edit_post_link( __( 'Edit', '_s' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->