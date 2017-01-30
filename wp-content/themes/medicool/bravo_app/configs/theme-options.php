<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 2/28/15
 * Time: 7:01 PM
 */

/**
 *
 * List all theme options fields
 *
 * @see BravoOptiontree::_add_themeoptions();
 *
 *
 * */
$config['theme_options'] = array(
	'sections' => array(
		array(
			'id'    => 'option_general',
			'title' => esc_html__('General Options', "medicool")
		),
		array(
			'id'    => 'option_header',
			'title' => esc_html__('Menu Options', "medicool")
		),
		array(
			'id'    => 'option_post',
			'title' => esc_html__('Posts Options', "medicool")
		),
		array(
			'id'    => 'option_departments',
			'title' => esc_html__('Departments Options', "medicool")
		),
		array(
			'id'    => 'option_gallery',
			'title' => esc_html__('Gallery Options', "medicool")
		),
		array(
			'id'    => 'option_style',
			'title' => esc_html__('Styling Options', "medicool")
		),
		array(
			'id'    => 'option_footer',
			'title' => esc_html__('Footer Options', "medicool")
		)
	),
	'settings' => array(
		/*----------------Begin General --------------------*/


		array(
			'id'      => 'logo',
			'label'   => esc_html__('Logo', "medicool"),
			'desc'    => esc_html__('This allow you to change logo', "medicool"),
			'type'    => 'upload',
			'section' => 'option_general',
		),

		array(
			'id'      => 'logo_retina',
			'label'   => esc_html__('Logo Retina', "medicool"),
			'desc'    => esc_html__('Note: You MUST re-name Logo Retina to logo-name@2x.ext-name. Example:<br>
                                    Logo is: <em>my-logo.jpg</em><br>Logo Retina must be: <em>my-logo@2x.jpg</em>  ', "medicool"),
			'type'    => 'upload',
			'section' => 'option_general',
		),


		array(
			'id'       => 'body_wrapper',
			'label'    => esc_html__("Wrapper version", "medicool"),
			'type'     => 'select',
			'desc'     => esc_html__("Wrapper version", "medicool"),
			'section'  => 'option_general',
			'choices'     => array(
				array(
					'value'       => 'v1',
					'label'       => esc_html__( '-- Version 1 --', "medicool" ),
					'src'         => ''
				),
				array(
					'value'       => 'v2',
					'label'       => esc_html__( '-- Version 2 --', "medicool" ),
					'src'         => ''
				),
				array(
					'value'       => 'v3',
					'label'       => esc_html__( '-- Version 3 --', "medicool" ),
					'src'         => ''
				),
			)
		),
		array(
			'id'      => 'bravo_google_api_key',
			'label'   => esc_html__('Google API Key', "medicool"),
			'type'    => 'text',
			'std'     => '',
			'section' => 'option_general',
		),
		array(
			'id'        => 'top_bar_left',
			'label'     => esc_html__('Top Bar Left', "medicool"),
			'desc'     => esc_html__("Top Bar Left", "medicool"),
			'type'      => 'textarea-simple',
			'section'   => 'option_general',
			'rows'        => '3',
		),
		array(
			'id'        => 'top_bar_right',
			'label'     => esc_html__('Top Bar Right', "medicool"),
			'desc'     => esc_html__("Top Bar Right", "medicool"),
			'type'      => 'textarea-simple',
			'section'   => 'option_general',
			'rows'        => '3',
		),


		/*----------------End General ----------------------*/

		/*----------------Begin Header ----------------------*/
		array(
			'id'      => 'enable_search_menu',
			'label'   => esc_html__('Enable Search On Menu ?', "medicool"),
			'type'    => 'on-off',
			'std'     => 'off',
			'section' => 'option_header'
		),
		array(
			'id'      => 'extra_menu',
			'label'    => esc_html__("Extra Menu", "medicool"),
			'desc'     => esc_html__("Extra Menu", "medicool"),
			'type'     => 'list-item',
			'section'  => 'option_header',
			'settings' => array(
				array(
					'id'    => 'content',
					'label' => esc_html__("Content", "medicool"),
					'type'  => 'textarea_simple',
				),
			)
		),

		/*----------------End Header ----------------------*/



		/*----------------Begin  Styling ----------------------*/
		array(
			'id'      => 'main_color',
			'label'   => esc_html__('Main Color', "medicool"),
			'desc'    => esc_html__('Choose your own main color', "medicool"),
			'type'    => 'colorpicker',
			'section' => 'option_style',
			'std'     => '#01bab0'
		),
		array(
			'id'      => 'google_fonts',
			'label'   => esc_html__('Google Fonts', "medicool"),
			'desc'    => esc_html__('Google Fonts', "medicool"),
			'type'    => 'google-fonts',
			'section' => 'option_style'
		),
		array(
			'id'      => 'body_font',
			'label'   => esc_html__("Typography", "medicool"),
			'desc'    => esc_html__("Typography", "medicool"),
			'type'    => 'typography',
			'section' => 'option_style',
			'output'  => 'body,p'
		),
		array(
			'id'      => 'heading_font',
			'label'   => esc_html__("Heading Font", "medicool"),
			'desc'    => esc_html__("Heading Font", "medicool"),
			'type'    => 'typography',
			'section' => 'option_style',
			'output'  => 'h1,h2,h3,h4,h5'
		),
		array(
			'id'      => 'style_custom_css',
			'label'   => esc_html__('Custom CSS', "medicool"),
			'desc'    => esc_html__('Custom CSS', "medicool"),
			'type'    => 'css',
			'section' => 'option_style',
		),
		/*----------------End Styling ----------------------*/
		/*----------------Begin Posts Options ----------------------*/
		array(
			'id'      => 'post_blog_tab',
			'label'   => esc_html__('Blog Options', "medicool"),
			'type'    => 'tab',
			'section' => 'option_post'
		),
		array(
			'id'      => 'enable_head_page',
			'label'   => esc_html__('Enable Banner ?', "medicool"),
			'type'    => 'on-off',
			'std'     => 'off',
			'section' => 'option_post'
		),
		array(
			'id'      => 'post_blog_title',
			'label'   => esc_html__('Blog page title', "medicool"),
			'type'    => 'text',
			'std'     => 'Blog',
			'section' => 'option_post',
			'condition' => 'enable_head_page:is(on)' ,
		),
		array(
			'id'      => 'blog_background_image',
			'label'   => esc_html__('Blog page background image', "medicool"),
			'desc'    => esc_html__('Blog page background image', "medicool"),
			'type'    => 'upload',
			'std'     => '',
			'section' => 'option_post',
			'condition' => 'enable_head_page:is(on)' ,
		),
		array(
			'id'      => 'page_sidebar_pos',
			'label'   => esc_html__("Sidebar Position", "medicool"),
			'type'    => 'select',
			'section' => 'option_post',
			'choices' => array(
				array(
					'value' => 'no',
					'label' => esc_html__("No Sidebar", "medicool")
				),
				array(
					'value' => 'left',
					'label' => esc_html__("Sidebar Left", "medicool")
				),
				array(
					'value' => 'right',
					'label' => esc_html__("Sidebar Right", "medicool")
				),
			)
		),
		array(
			'id'      => 'page_sidebar_id',
			'label'   => esc_html__("Widget Area Selection", "medicool"),
			'type'    => 'sidebar-select',
			'section' => 'option_post',
			'std'     => 'blog-sidebar'
		),
        array(
            'id'      => 'post_exerpt_length',
            'label'   => esc_html__("Show Exerpt Length", "medicool"),
            'type'        => 'numeric-slider',
            'section' => 'option_post',
            'std'     => '15',
            'min_max_step'=> '10,100,5',
        ),



		/*----------------End Posts Options ----------------------*/

		/*----------------Option Departments  ----------------------*/
		array(
			'id'      => 'head_departments_tab',
			'label'   => esc_html__('Banner Options', "medicool"),
			'type'    => 'tab',
			'section' => 'option_departments'
		),

		array(
			'id'      => 'enable_head_departments',
			'label'   => esc_html__('Enable Banner ?', "medicool"),
			'type'    => 'on-off',
			'std'     => 'off',
			'section' => 'option_departments'
		),
		array(
			'id'      => 'head_departments_title',
			'label'   => esc_html__('Departments page title', "medicool"),
			'type'    => 'text',
			'std'     => '',
			'section' => 'option_departments',
			'condition' => 'enable_head_departments:is(on)' ,
		),
		array(
			'id'      => 'head_departments_image',
			'label'   => esc_html__('Departments page background image', "medicool"),
			'desc'    => esc_html__('Departments page background image', "medicool"),
			'type'    => 'upload',
			'std'     => '',
			'section' => 'option_departments',
			'condition' => 'enable_head_departments:is(on)' ,
		),
		array(
			'id'      => 'departments_tab',
			'label'   => esc_html__('Departments Options', "medicool"),
			'type'    => 'tab',
			'section' => 'option_departments'
		),
		array(
			'id'      => 'departments_single_sidebar_pos',
			'label'   => esc_html__("Sidebar Position", "medicool"),
			'type'    => 'select',
			'section' => 'option_departments',
			'choices' => array(
				array(
					'value' => 'no',
					'label' => esc_html__("No Sidebar", "medicool")
				),
				array(
					'value' => 'left',
					'label' => esc_html__("Sidebar Left", "medicool")
				),
				array(
					'value' => 'right',
					'label' => esc_html__("Sidebar Right", "medicool")
				),
			)
		),
		array(
			'id'      => 'departments_single_sidebar_id',
			'label'   => esc_html__("Widget Area Selection", "medicool"),
			'type'    => 'sidebar-select',
			'section' => 'option_departments',
			'std'     => 'blog-sidebar'
		),
		/*----------------End Option Departments ----------------------*/

		/*----------------Option Departments  ----------------------*/
		array(
			'id'      => 'head_gallery_tab',
			'label'   => esc_html__('Banner Options', "medicool"),
			'type'    => 'tab',
			'section' => 'option_gallery'
		),

		array(
			'id'      => 'enable_head_gallery',
			'label'   => esc_html__('Enable Banner ?', "medicool"),
			'type'    => 'on-off',
			'std'     => 'off',
			'section' => 'option_gallery'
		),
		array(
			'id'      => 'head_gallery_title',
			'label'   => esc_html__('Gallery page title', "medicool"),
			'type'    => 'text',
			'std'     => '',
			'section' => 'option_gallery',
			'condition' => 'enable_head_gallery:is(on)' ,
		),
		array(
			'id'      => 'head_gallery_image',
			'label'   => esc_html__('Gallery page background image', "medicool"),
			'desc'    => esc_html__('Gallery page background image', "medicool"),
			'type'    => 'upload',
			'std'     => '',
			'section' => 'option_gallery',
			'condition' => 'enable_head_gallery:is(on)' ,
		),
		/*----------------End Option Departments ----------------------*/

		/*----------------Footer Options ----------------------*/
		array(
			'id'        => 'footer_copyright',
			'label'     => esc_html__('Footer Copy Right', "medicool"),
			'type'      => 'textarea',
			'section'   => 'option_footer',
		),
		array(
			'id'        => 'footer_template',
			'label'     => esc_html__('Footer Template', "medicool"),
			'type'      => 'page-select',
			'section'   => 'option_footer',
		),
		array(
			'id'       => 'footer_social',
			'label'    => esc_html__("Footer Social", "medicool"),
			'type'     => 'list-item',
			'section'  => 'option_footer',
			'settings' => array(
				array(
					'id'    => 'icon',
					'label' => esc_html__("Icon", "medicool"),
					'type'  => 'text',
				),
				array(
					'id'    => 'link',
					'label' => esc_html__("Link", "medicool"),
					'type'  => 'text',
				),
				array(
					'id'    => 'color',
					'label' => esc_html__("Color", "medicool"),
					'type'  => 'colorpicker',
				),
			)

		),
		/*----------------End Footer Options ----------------------*/


	)
);
