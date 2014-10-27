<?php
/*
Plugin Name: Social Feed
Plugin URI:
Description: Retrieves posts from Facebook, Instagram, and Twitter and displays the latest N number of them.
Version: 1.0
Author: TMBR
Author URI: http://wearetmbr.com/
*/

function socialfeed_autoloader($class)
{
	$class = strtolower($class);
	$class = str_replace(
		array( 'socialfeed\\', '\\' ),
		array( '' , '/' ),
		$class
	);
	$try_file = dirname(__FILE__) . '/' . $class . '.php';
	if ( file_exists( $try_file ) )
	{
		require_once $try_file;
	}
}
spl_autoload_register('socialfeed_autoloader');

\SocialFeed\Controller::i()->add_actions();
