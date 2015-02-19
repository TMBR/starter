<?php

add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');



function my_custom_dashboard_widgets() {

global $wp_meta_boxes;

wp_add_dashboard_widget('custom_help_widget', 'TMBR Starter Theme', 'custom_dashboard_help');

}



function custom_dashboard_help() {

echo '

<p>This is the custom starter theme by TMBR. Check out functions.php to discover everything this theme can do!</p>
<p>Some functionality:</p>
<ul>
	<li>Pure CSS dropdown menu</li>

</ul>
';

}

?>