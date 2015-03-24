<?php

// Creates custom post type
// http://codex.wordpress.org/Function_Reference/register_post_type

add_action( 'init', 'create_post_type' );

	function create_post_type() {


	register_post_type( 'packages',
			array (	'label' => 'Packages',
				'description' => 'Packages and Specials',
				'public' => true,
				'show_ui' => true,
				'show_in_menu' => true,
				'capability_type' => 'post',
				'hierarchical' => true,
				'has_archive' => true,
				'rewrite' => true,
				'query_var' => true,
				'supports' => array('title','editor','thumbnail','page-attributes'),
				'taxonomies' => array(),
				'menu_icon' => 'dashicons-megaphone',

				'labels' =>
					array (
	  					'name' => 'Packages', /* This is the Title of the Group */
	  					'singular_name' => 'Package', /* This is the individual type */
						'menu_name' => 'Packages', /* The add new menu item */
						'add_new' => 'Add Package', /* Add New Display Title */
						'add_new_item' => 'Add New Package',
						'edit' => 'Edit', /* Edit Dialog */
						'edit_item' => 'Edit Package', /* Edit Display Title */
						'new_item' => 'New Package', /* New Display Title */
						'view_item' => 'View Package', /* View Display Title */
						'search_items' => 'Search Packages', /* Search Custom Type Title */
						'not_found' => 'No Packages Found', /* This displays if there are no entries yet */
						'not_found_in_trash' => 'No Packages Found in Trash' /* This displays if there is nothing in the trash */
						),
			)
	); // End Packages Post type

	register_post_type( 'activities',
			array (	'label' => 'Activities',
				'description' => '',
				'public' => true,
				'show_ui' => true,
				'show_in_menu' => true,
				'capability_type' => 'post',
				'hierarchical' => true,
				'has_archive' => true,
				'rewrite' => true,
				'query_var' => true,
				'supports' => array('title','editor','thumbnail','page-attributes'),
				'taxonomies' => array(),
				'menu_icon' => 'dashicons-location-alt',

				'labels' =>
					array (
	  					'name' => 'Activities', /* This is the Title of the Group */
	  					'singular_name' => 'Activity', /* This is the individual type */
						'menu_name' => 'Activities', /* The add new menu item */
						'add_new' => 'Add Activity', /* Add New Display Title */
						'add_new_item' => 'Add New Activity',
						'edit' => 'Edit', /* Edit Dialog */
						'edit_item' => 'Edit Activity', /* Edit Display Title */
						'new_item' => 'New Activity', /* New Display Title */
						'view_item' => 'View Activity', /* View Display Title */
						'search_items' => 'Search Activities', /* Search Custom Type Title */
						'not_found' => 'No Activities Found', /* This displays if there are no entries yet */
						'not_found_in_trash' => 'No Activities Found in Trash' /* This displays if there is nothing in the trash */
						),
			)
	); // End Activities
}
