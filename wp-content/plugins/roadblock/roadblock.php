<?php 
    /*
    Plugin Name: Roadblock Signup
    Plugin URI: http://www.wearetmbr.net
    Description: This plugin displays a subscribe form roadblock when users have viewed 3 pages on a website. If the user closes the window, this roadblock does not reappear for 60 days. 
    Author: Galen Strasen, TMBR
    Version: 1.0
    */


function rdblk_admin() {
	include('roadblock_admin.php');
}

function rdblk_admin_actions() {
	add_management_page('Roadblock Options', 'Roadblock Signup', 'manage_options', 'roadblock-options.php', 'rdblk_admin');
}

add_action('admin_menu','rdblk_admin_actions');


?>