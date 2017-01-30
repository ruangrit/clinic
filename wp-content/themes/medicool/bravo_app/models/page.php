<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 3/3/15
 * Time: 7:41 PM
 */

if (!class_exists('BravoPage')) {
    class BravoPage
    {
        static function _init()
        {
            if (function_exists('vc_add_param')) {
                add_action('init', array(__CLASS__, '_init_elements'));

            }
            add_action('init', array(__CLASS__, '_add_metabox'));

            //add_filter('vc_tta_container_classes', array(__CLASS__, '_add_tab_class'), 10, 2);

            //add_filter('vc-tta-get-params-tabs-list',array(__CLASS__,'_add_tab_icon'),10,4);

            add_filter( 'vc_shortcodes_css_class' , array(
                __CLASS__ ,
                'css_classes_for_vc_row_and_vc_column'
            ) , 10 , 2 );

        }

        static function _add_tab_icon($html, $atts, $content, $this_object){



            $isPageEditabe = vc_is_page_editable();

            $html = array();
            $html[] = '<div class="vc_tta-tabs-container">';
            $html[] = '<ul class="vc_tta-tabs-list">';
            if ( ! $isPageEditabe ) {

                $active_section = $this_object->getActiveSection( $atts, true );

                foreach ( WPBakeryShortCode_VC_Tta_Section::$section_info as $nth => $section ) {
                    $classes = array( 'vc_tta-tab' );
                    if ( ( $nth + 1 ) === $active_section ) {
                        $classes[] = $this_object->activeClass;
                    }
                    $data_icon=false;
                    $data_icon=isset($section['bravo_icon'])?$section['bravo_icon']:false;

                    $title = '<span class="vc_tta-title-text">' . $section['title'] . '</span>';
                    if ( 'true' === $section['add_icon'] ) {
                        $icon_html = '<span class="bravo_js_icon" data-icon="'.esc_attr($data_icon).'">'.balanceTags($this_object->constructIcon( $section )).'</span>';
                        if ( 'left' === $section['i_position'] ) {
                            $title = $icon_html . $title;
                        } else {
                            $title = $title . $icon_html;
                        }
                    }
                    $a_html = '<a href="#' . $section['tab_id'] . '" data-vc-tabs data-vc-container=".vc_tta">' . $title . '</a>';
                    $html[] = '<li class="' . implode( ' ', $classes ) . '" data-vc-tab>' . $a_html . '</li>';
                }
            }

            $html[] = '</ul>';
            $html[] = '</div>';

            return apply_filters( 'bravo-tta-get-params-tabs-list', $html, $atts, $content, $this_object );
        }
        static function _add_tab_class($class, $att = array())
        {
            $att = wp_parse_args($att, array(
                'bravo_service_tab' => ''
            ));

            if ($att['bravo_service_tab'] == 'true') {
                $class[] = 'services';
            }

            return $class;
        }

        static function _init_elements()
        {



            vc_add_param( 'vc_row' , array(
                    "type"       => "dropdown" ,
                    "heading"    => esc_html__( 'Bravo Full Width' , "medicool" ) ,
                    "param_name" => "row_fullwidth" ,
                    "value"      => array(
                        esc_html__( 'No' , "medicool" )  => 'no' ,
                        esc_html__( 'Yes' , "medicool" ) => 'yes' ,
                    ) ,
                )
            );

            vc_add_param( 'vc_row_inner' , array(
                    "type"       => "dropdown" ,
                    "heading"    => esc_html__( 'Bravo Full Width' , "medicool" ) ,
                    "param_name" => "row_fullwidth" ,
                    "value"      => array(
                        esc_html__( 'No' , "medicool" )  => 'no' ,
                        esc_html__( 'Yes' , "medicool" ) => 'yes' ,
                    ) ,
                )
            );


        }

        static function _add_metabox()
        {
            $my_meta_box = array(
                'id'       => 'bravo_page_metabox',
                'title'    =>esc_html__('Page Information', "medicool"),
                'desc'     => '',
                'pages'    => array('page'),
                'context'  => 'normal',
                'priority' => 'high',
                'fields'   => array(
                    array(
                        'label' => esc_html__( 'General' , "medicool" ) ,
                        'type'  => 'tab' ,
                        'id'    => 'gen_tab'
                    ) ,
                    array(
                        'id'      => 'st_custom_logo' ,
                        'label'   => esc_html__( 'Custom Logo ?' , "medicool" ) ,
                        'std'     => 'off' ,
                        'type'    => 'on-off' ,
                    ) ,
                    array(
                        'id'      => 'logo',
                        'label'   => esc_html__('Logo', "medicool"),
                        'desc'    => esc_html__('This allow you to change logo', "medicool"),
                        'type'    => 'upload',
                        'condition' => 'st_custom_logo:is(on)'
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
                        'id'      => 'st_custom_top_bar' ,
                        'label'   => esc_html__( 'Custom Top Bar ?' , "medicool" ) ,
                        'std'     => 'off' ,
                        'type'    => 'on-off' ,
                    ) ,
                    array(
                        'id'        => 'top_bar_left',
                        'label'     => esc_html__('Top Bar Left', "medicool"),
                        'desc'     => esc_html__("Top Bar Left", "medicool"),
                        'type'      => 'textarea-simple',
                        'rows'        => '3',
                        'condition' => 'st_custom_top_bar:is(on)'
                    ),
                    array(
                        'id'        => 'top_bar_right',
                        'label'     => esc_html__('Top Bar Right', "medicool"),
                        'desc'     => esc_html__("Top Bar Right", "medicool"),
                        'type'      => 'textarea-simple',
                        'rows'        => '3',
                        'condition' => 'st_custom_top_bar:is(on)'
                    ),
                    array(
                        'id'      => 'custom_extra_menu',
                        'label'   => esc_html__('Custom Extra Menu ?', "medicool"),
                        'type'    => 'on-off',
                        'std'     => 'off',
                        'section' => 'option_post'
                    ),
                    array(
                        'id'      => 'extra_menu',
                        'label'    => esc_html__("Extra Menu", "medicool"),
                        'desc'     => esc_html__("Extra Menu", "medicool"),
                        'type'     => 'list-item',
                        'section'  => 'option_header',
                        'condition' => 'custom_extra_menu:is(on)',
                        'settings' => array(
                            array(
                                'id'    => 'content',
                                'label' => esc_html__("Content", "medicool"),
                                'type'  => 'textarea_simple',
                            ),
                        )
                    ),
                    array(
                        'id'      => 'custom_enable_search_menu',
                        'label'   => esc_html__("Custom Search On Menu ?", "medicool"),
                        'type'    => 'select',
                        'choices' => array(
                            array(
                                'value' => '',
                                'label' => esc_html__("-- Select --", "medicool")
                            ),
                            array(
                                'value' => 'on',
                                'label' => esc_html__("On", "medicool")
                            ),
                            array(
                                'value' => 'off',
                                'label' => esc_html__("Off", "medicool")
                            ),
                        )
                    ),



                    array(
                        'label' => esc_html__( 'Options for Template Blog' , "medicool" ) ,
                        'type'  => 'tab' ,
                        'id'    => 'option_for_template_blog_tab'
                    ) ,
                    array(
                        'id'      => 'page_blog_view',
                        'label'   => esc_html__("Blog type view", "medicool"),
                        'type'    => 'select',
                        'choices' => array(
                            array(
                                'value' => '6',
                                'label' => esc_html__("2 Columns", "medicool")
                            ),
                            array(
                                'value' => '4',
                                'label' => esc_html__("3 Columns", "medicool")
                            ),
                            array(
                                'value' => '4',
                                'label' => esc_html__("4 Columns", "medicool")
                            ),
                        )
                    ),
                    array(
                        'id'      => 'enable_head_page',
                        'label'   => esc_html__('Custom Banner ?', "medicool"),
                        'type'    => 'on-off',
                        'std'     => 'off',
                    ),
                    array(
                        'id'      => 'post_blog_title',
                        'label'   => esc_html__('Blog page title', "medicool"),
                        'type'    => 'text',
                        'std'     => 'Blog',
                        'condition' => 'enable_head_page:is(on)' ,
                    ),
                    array(
                        'id'      => 'blog_background_image',
                        'label'   => esc_html__('Blog page background image', "medicool"),
                        'desc'    => esc_html__('Blog page background image', "medicool"),
                        'type'    => 'upload',
                        'std'     => '',
                        'condition' => 'enable_head_page:is(on)' ,
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

        static function css_classes_for_vc_row_and_vc_column( $class_string , $tag )
        {
            if($tag == 'vc_row' || $tag == 'vc_row_inner') {
                $class_string = str_replace( 'vc_row-fluid' , '' , $class_string );
            }

            if(defined( 'WPB_VC_VERSION' )) {
                if(version_compare( WPB_VC_VERSION , '4.2.3' , '>' )) {
                    if($tag == 'vc_column' || $tag == 'vc_column_inner') {
                        //$class_string = preg_replace('/vc_span(\d{1,2})/', 'col-lg-$1', $class_string);
                        $class_string = str_replace( 'vc_col' , 'col' , $class_string );
                        $class_string = str_replace( 'col-sm' , 'col-md' , $class_string );
                    }
                } else {
                    if($tag == 'vc_column' || $tag == 'vc_column_inner') {
                        $class_string = preg_replace( '/vc_span(\d{1,2})/' , 'col-lg-$1' , $class_string );
                        $class_string = str_replace( 'col-sm' , 'col-md' , $class_string );
                    }
                }
            }

            return $class_string;
        }



    }

    BravoPage::_init();
}
