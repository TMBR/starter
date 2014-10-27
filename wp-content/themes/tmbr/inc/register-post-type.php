<?php

// Creates custom post type called "Clients"
// http://codex.wordpress.org/Function_Reference/register_post_type

add_action( 'init', 'create_post_type' );

	function create_post_type() {


	register_post_type( 'clients',
			array (	'label' => 'Clients',
				'description' => '',
				'public' => true,
				'show_ui' => true,
				'show_in_menu' => true,
				'capability_type' => 'post',
				'hierarchical' => false,
				'rewrite' => true,
				'query_var' => true,
				'supports' => array('title','thumbnail'),
				'taxonomies' => array(),
				'labels' =>
					array (
	  					'name' => 'Clients', /* This is the Title of the Group */
	  					'singular_name' => 'Client', /* This is the individual type */
						'menu_name' => 'Clients', /* The add new menu item */
						'add_new' => 'Add Client', /* Add New Display Title */
						'add_new_item' => 'Add New Client',
						'edit' => 'Edit', /* Edit Dialog */
						'edit_item' => 'Edit Client', /* Edit Display Title */
						'new_item' => 'New Client', /* New Display Title */
						'view_item' => 'View Client', /* View Display Title */
						'search_items' => 'Search Clients', /* Search Custom Type Title */
						'not_found' => 'No Clients Found', /* This displays if there are no entries yet */
						'not_found_in_trash' => 'No Clients Found in Trash' /* This displays if there is nothing in the trash */
						),
				)
			);
		?>

		<!--
			register_post_type( 'snow_reports',
			array (	'label' => 'Snow Reports',
			'description' => '',
			'public' => false,
			'show_ui' => true,
			'show_in_menu' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'supports' => false,
			'taxonomies' => array(),
			'labels' =>
				array (
				'name' => 'Snow Reports', /* This is the Title of the Group */
				'singular_name' => 'Snow Report', /* This is the individual type */
				'menu_name' => 'Snow Reports', /* The add new menu item */
				'add_new' => 'Add Snow Report', /* Add New Display Title */
				'add_new_item' => 'Add New Snow Report',
				'edit' => 'Edit', /* Edit Dialog */
				'edit_item' => 'Edit Snow Reports', /* Edit Display Title */
				'new_item' => 'New Snow Report', /* New Display Title */
				'view_item' => 'View Snow Reports', /* View Display Title */
				'search_items' => 'Search Snow Reports', /* Search Custom Type Title */
				'not_found' => 'No Snow Reports Found', /* This displays if there are no entries yet */
				'not_found_in_trash' => 'No Snow Reports Found in Trash' /* This displays if there is nothing in the trash */
				),
			)
		);
		-->

		<?php

			/* this ads your post categories to your custom post type */
			register_taxonomy_for_object_type('category', 'clients');

			/* this ads your post tags to your custom post type */
			register_taxonomy_for_object_type('post_tag', 'clients');

}


?>