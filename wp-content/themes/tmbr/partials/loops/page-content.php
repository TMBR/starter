<?php
/**
 * The template used for displaying page content in page.php
 *
 *
 */
?>
<div class="container">
	<div class="row">
		<div class="col-xs-12">

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header hidden">
				<?php the_title( '<h2 itemprop="headline" class="entry-title animation" data-animation="animation-fade-in-down">', '</h2>' ); ?>
				</header><!-- .entry-header -->

				<div itemprop="text" class="entry-content animation" data-animation="animation-fade-in-up">
					<?php
					the_content();

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

		</div><!-- /col -->
	</div><!-- /row -->
</div><!-- /container -->