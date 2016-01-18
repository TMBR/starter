<?php

// TMBR Helpers - always include this first, so other files can rely on it
get_template_part( 'inc/helpers' );

// Theme Setup & Enqueue
get_template_part( 'inc/theme-setup' );
get_template_part( 'inc/load-scripts' );


// Hide Admin Bar for Dev Purposes - this can also be done via Dashboard in WP Engine options
add_filter( 'show_admin_bar', '__return_false' );


// Theme Supports
get_template_part( 'inc/page-excerpt' );
get_template_part( 'inc/options-pages' );

// Customization

// get_template_part( 'inc/register-post-type' );
// get_template_part( 'inc/register-taxonomy' );
get_template_part( 'inc/register-sidebars' );
get_template_part( 'inc/register-menus' );
get_template_part( 'inc/custom-img-size' );

// Functions
// @define( 'cat_featured', 17 ); // define cat or other terms
// get_template_part( 'inc/is-tree' ); // is tree relation
// get_template_part( 'inc/shortcodes' );




