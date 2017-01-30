<?php
/**
 * Created by PhpStorm.
 * User: MrHa
 * Date: 3/12/2015
 * Time: 9:22 AM
 */
if (!class_exists('BravoGallery')) {

	class BravoGallery
	{
		static $content;

		static function __init()
		{

			if (function_exists('bravo_reg_post_type')) {
				add_action('init', array(__CLASS__, '__register_post_type'));
			}

			add_action('init', array(__CLASS__, '__add_metabox'));
			add_action('init', array(__CLASS__, '_init_elements'));


		}

		static function __register_post_type()
		{
			$labels = array(
				'name'               => esc_html__('Gallery', "medicool"),
				'singular_name'      => esc_html__('Gallery', "medicool"),
				'menu_name'          => esc_html__('Gallery', "medicool"),
				'name_admin_bar'     => esc_html__('Gallery', "medicool"),
				'add_new'            => esc_html__('Add New', "medicool"),
				'add_new_item'       => esc_html__('Add New Gallery', "medicool"),
				'new_item'           => esc_html__('New Gallery', "medicool"),
				'edit_item'          => esc_html__('Edit Gallery', "medicool"),
				'view_item'          => esc_html__('View Gallery', "medicool"),
				'all_items'          => esc_html__('All Gallery', "medicool"),
				'search_items'       => esc_html__('Search Gallery', "medicool"),
				'parent_item_colon'  => esc_html__('Parent Gallery:', "medicool"),
				'not_found'          => esc_html__('No Gallery found.', "medicool"),
				'not_found_in_trash' => esc_html__('No Gallery found in Trash.', "medicool")
			);

			$args = array(
				'labels'             => $labels,
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'query_var'          => true,
				'rewrite'            => array('slug' => 'bravo_gallery'),
				'capability_type'    => 'post',
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => null,
				'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt'),
				'menu_icon'          => 'dashicons-bravo-portfolio'
			);
			bravo_reg_post_type('bravo_gallery', $args);


			$labels = array(
				'name'              => esc_html__('Gallery Categories', "medicool"),
				'singular_name'     => esc_html__('Gallery Category', "medicool"),
				'search_items'      => esc_html__('Search Gallery Categories', "medicool"),
				'all_items'         => esc_html__('All Gallery Categories', "medicool"),
				'parent_item'       => esc_html__('Parent Gallery Category', "medicool"),
				'parent_item_colon' => esc_html__('Parent Gallery Category:', "medicool"),
				'edit_item'         => esc_html__('Edit Gallery Category', "medicool"),
				'update_item'       => esc_html__('Update Gallery Category', "medicool"),
				'add_new_item'      => esc_html__('Add New Gallery Category', "medicool"),
				'new_item_name'     => esc_html__('New Gallery Category Name', "medicool"),
				'menu_name'         => esc_html__('Gallery Category', "medicool"),
			);

			$args = array(
				'hierarchical'      => true,
				'labels'            => $labels,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => array('slug' => 'bravo_gallery_cat'),
			);

			bravo_reg_taxonomy('bravo_gallery_cat', array('bravo_gallery'), $args);


		}

		static function __add_metabox()
		{
			$my_meta_box = array(
				'id'       => 'bravo_gallery_metabox',
				'title'    => esc_html__('Settings', "medicool"),
				'desc'     => '',
				'pages'    => array('bravo_gallery'),
				'context'  => 'normal',
				'priority' => 'high',
				'fields'   => array(
					array(
						'label' => esc_html__( 'General' , "medicool" ) ,
						'type'  => 'tab' ,
						'id'    => 'gen_tab'
					) ,
					array(
						'label' => esc_html__('Gallery', "medicool"),
						'id'    => 'gallery',
						'type'  => 'gallery'
					),
					array(
						'id'       => 'social',
						'label'    => esc_html__("Social", 'medicool'),
						'type'     => 'list-item',
						'section'  => 'option_footer',
						'settings' => array(
							array(
								'id'    => 'icon',
								'label' => esc_html__("Icon", 'medicool'),
								'type'  => 'text',
							),
							array(
								'id'    => 'link',
								'label' => esc_html__("Link", 'medicool'),
								'type'  => 'text',
							),
						)

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

		static function _like()
		{
			if ($_POST) {
				$ip = $_SERVER['REMOTE_ADDR'];
				$id = $_POST['id'];
			}
		}

		static function addFooterHtml($html)
		{
			self::$content[] = $html;
		}

		static function getFooterHtml()
		{
			if (!empty(self::$content)) {
				foreach (self::$content as $item => $value) {
					echo($value);
				}
			}
		}
	}


	BravoGallery::__init();
}