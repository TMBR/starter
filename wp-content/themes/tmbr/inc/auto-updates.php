<?php
// Turn on auto-updates for our installs
add_filter( 'automatic_updates_is_vcs_checkout', '__return_false', 1 );
add_filter( 'allow_minor_auto_core_updates', '__return_true' );
add_filter( 'auto_update_plugin', '__return_true' );
add_filter( 'auto_update_theme', '__return_true' );
