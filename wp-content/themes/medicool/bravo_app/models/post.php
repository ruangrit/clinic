<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 6/18/15
 * Time: 9:36 PM
 */
if (!class_exists('Bravo_Post_Model')) {
	class Bravo_Post_Model
	{
		static function _init()
		{
			add_action('init', array(__CLASS__, '_add_metabox'));
			add_action('init', array(__CLASS__, '_add_metabox2'));

			add_filter('bravo_post_single_label', array(__CLASS__, '_bravo_post_single_label'));
			add_filter('bravo_post_single_icon', array(__CLASS__, '_bravo_post_single_icon'));
			add_filter('bravo_header_bg_line', array(__CLASS__, '_bravo_header_bg_line'));
		}

		static function _bravo_header_bg_line($label)
		{
			if (!is_page_template('template-blank.php')) {
				return FALSE;
			}

			return $label;
		}

		static function _bravo_post_single_icon($icon)
		{
			if (is_singular()) {
				$meta = get_post_meta(get_the_ID(), 'page_icon', TRUE);
				if ($meta) $icon = $meta;
			}

			return $icon;
		}

		static function _bravo_post_single_label($label)
		{
			if (is_singular()) {
				$meta = get_post_meta(get_the_ID(), 'page_label', TRUE);
				if ($meta) $label = $meta;
			}

			return $label;
		}

		static function _add_metabox()
		{
			$my_meta_box = array(
				'id'       => 'bravo_post_metabox',
				'title'    =>esc_html__('Post Information', 'medicool'),
				'desc'     => '',
				'pages'    => array('post'),
				'context'  => 'normal',
				'priority' => 'high',
				'fields'   => array(
					array(
						'label' => esc_html__( 'General' , 'medicool' ) ,
						'type'  => 'tab' ,
						'id'    => 'gen_tab'
					),
					array(
						'id'    => 'media_url',
						'label' =>esc_html__('Media URL', 'medicool'),
						'desc'  =>esc_html__('You can use Youtube and Vimeo URL, also sounclound for audio post format', 'medicool'),
						'type'  => 'text',

					),
					array(
						'id'    => 'author_name',
						'label' =>esc_html__('Author Name', 'medicool'),
						'desc'  =>esc_html__('Only use for Link and Quote Format', 'medicool'),
						'type'  => 'text',

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

		static function _add_metabox2()
		{
			$my_meta_box = array(
				'id'       => 'bravo_other_options',
				'title'    =>esc_html__('Other Options', 'medicool'),
				'desc'     => '',
				'pages'    => array('post', 'page'),
				'context'  => 'side',
				'priority' => 'default',
				'fields'   => array(
					array(
						'label'   =>esc_html__('Sidebar Position', 'medicool'),
						'id'      => 'sidebar_pos',
						'type'    => 'select',
						'choices' => array(
							array(
								'value' => '',
								'label' =>esc_html__("-- Select --", 'medicool')
							),
							array(
								'value' => 'no',
								'label' =>esc_html__("No Sidebar", 'medicool')
							),
							array(
								'value' => 'left',
								'label' =>esc_html__("Sidebar Left", 'medicool')
							),
							array(
								'value' => 'right',
								'label' =>esc_html__("Sidebar Right", 'medicool')
							),
						)
					),
					array(
						'label' =>esc_html__('Sidebar ID', 'medicool'),
						'id'    => 'sidebar_id',
						'type'  => 'sidebar-select'
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
	}

	Bravo_Post_Model::_init();
}