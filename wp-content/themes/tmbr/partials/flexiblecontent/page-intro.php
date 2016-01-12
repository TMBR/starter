<?php
/**
 * The template used for displaying standard page content
 *
 *
 */
?>

<article id="page-<?php the_ID(); ?>" <?php post_class(); ?> role="main" itemprop="mainContentOfPage">

  <header class="entry-header">
    <?php the_title( '<h1 itemprop="headline" class="entry-title">', '</h1>' ); ?>
  </header><!-- .entry-header -->

  <div class="entry-content" role="main" itemprop="text">
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

</article><!-- #page-## -->
