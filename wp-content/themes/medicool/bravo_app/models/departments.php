<?php
/**
 * Created by PhpStorm.
 * User: MrHa
 * Date: 3/12/2015
 * Time: 9:22 AM
 */
if (!class_exists('BravoDepartments')) {

	class BravoDepartments
	{
		static $content;

		static function __init()
		{

			if (function_exists('bravo_reg_post_type')) {
				add_action('init', array(__CLASS__, '__register_post_type'));
			}

			add_action('init', array(__CLASS__, '__add_metabox'));
			add_action('init', array(__CLASS__, '_init_elements'));

			add_filter('bravo_get_sidebar', array(__CLASS__, '_service_filter_sidebar'));

		}

		static function _service_filter_sidebar($sidebar)
		{
			if(is_singular('bravo_departments')){
				$pos = bravo_get_option('departments_single_sidebar_pos', 'right');

				$sidebar_id = bravo_get_option('departments_single_sidebar_id', 'blog-sidebar');

				$sidebar['id'] = $sidebar_id;

				$sidebar['position'] = $pos;

				if (BravoInput::get('sidebar_pos')) {
					$sidebar['position'] = BravoInput::get('sidebar_pos');
				}
				if (BravoInput::get('sidebar_id')) {
					$sidebar['id'] = BravoInput::get('sidebar_id');
				}
			}


			return $sidebar;
		}


		static function __register_post_type()
		{
			$labels = array(
				'name'               => esc_html__('Departments', "medicool"),
				'singular_name'      => esc_html__('Departments', "medicool"),
				'menu_name'          => esc_html__('Departments', "medicool"),
				'name_admin_bar'     => esc_html__('Departments', "medicool"),
				'add_new'            => esc_html__('Add New', "medicool"),
				'add_new_item'       => esc_html__('Add New Departments', "medicool"),
				'new_item'           => esc_html__('New Departments', "medicool"),
				'edit_item'          => esc_html__('Edit Departments', "medicool"),
				'view_item'          => esc_html__('View Departments', "medicool"),
				'all_items'          => esc_html__('All Departments', "medicool"),
				'search_items'       => esc_html__('Search Departments', "medicool"),
				'parent_item_colon'  => esc_html__('Parent Departments:', "medicool"),
				'not_found'          => esc_html__('No Departments found.', "medicool"),
				'not_found_in_trash' => esc_html__('No Departments found in Trash.', "medicool")
			);

			$args = array(
				'labels'             => $labels,
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'query_var'          => true,
				'rewrite'            => array('slug' => 'bravo_departments'),
				'capability_type'    => 'post',
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => null,
				'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt'),
				'menu_icon'          => 'dashicons-bravo-portfolio'
			);
			bravo_reg_post_type('bravo_departments', $args);



			$labels = array(
				'name'              => esc_html__('Departments Categories', "medicool"),
				'singular_name'     => esc_html__('Departments Category', "medicool"),
				'search_items'      => esc_html__('Search Departments Categories', "medicool"),
				'all_items'         => esc_html__('All Departments Categories', "medicool"),
				'parent_item'       => esc_html__('Parent Departments Category', "medicool"),
				'parent_item_colon' => esc_html__('Parent Departments Category:', "medicool"),
				'edit_item'         => esc_html__('Edit Departments Category', "medicool"),
				'update_item'       => esc_html__('Update Departments Category', "medicool"),
				'add_new_item'      => esc_html__('Add New Departments Category', "medicool"),
				'new_item_name'     => esc_html__('New Departments Category Name', "medicool"),
				'menu_name'         => esc_html__('Departments Category', "medicool"),
			);

			$args = array(
				'hierarchical'      => true,
				'labels'            => $labels,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => array('slug' => 'bravo_departments_cat'),
			);

			bravo_reg_taxonomy('bravo_departments_cat', array('bravo_departments'), $args);


		}

		static function __add_metabox()
		{
			$my_meta_box = array(
				'id'       => 'bravo_departments_metabox',
				'title'    => esc_html__('Departments Options', "medicool"),
				'desc'     => '',
				'pages'    => array('bravo_departments'),
				'context'  => 'normal',
				'priority' => 'high',
				'fields'   => array(
					array(
						'label' => esc_html__( 'General' , "medicool" ) ,
						'type'  => 'tab' ,
						'id'    => 'gen_tab'
					) ,
					array(
						'label' => esc_html__('Featured Icon', "medicool"),
						'id'    => 'featured_icon',
						'type'  => 'text'
					),

				)
			);


			/**
			 * Register our meta boxes using the
			 * ot_register_meta_box() function.
			 */
			if (function_exists('ot_register_meta_box')) {
				ot_register_meta_box($my_meta_box);
			}

		}

		static function _init_elements()
		{

		}

	}


	BravoDepartments::__init();
}