<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 2/28/15
 * Time: 10:07 PM
 */

if (!class_exists('BravoGeneral')) {

    class BravoGeneral
    {
        static function _init()
        {
            //Default Framwork Hooked

            add_action('wp', array(__CLASS__, '_setup_author'));
            add_action('after_setup_theme', array(__CLASS__, '_after_setup_theme'));
            add_action('widgets_init', array(__CLASS__, '_add_sidebars'));

            add_action('wp_enqueue_scripts', array(__CLASS__, '_add_scripts'));

            //Custom hooked
            add_filter('bravo_get_sidebar', array(__CLASS__, '_blog_filter_sidebar'));
            add_action('init', array(__CLASS__, '_init_elements'));
            //add_action('bravo_before_main_content', array(__CLASS__, '_add_breadcrumb'));

            //add_action('wp_head', array(__CLASS__, '_show_custom_css'), 100);
            add_action( 'wp_enqueue_scripts', array(__CLASS__, '_show_custom_css') );

            add_filter('body_class', array(__CLASS__, '_add_body_class'));



            // Header image
            add_action('bravo_header_image_src', array(__CLASS__, '_home_page_header_img'));

            add_filter('st_blog_title',array(__CLASS__,'_st_blog_title'));

            add_filter( 'excerpt_length',array(__CLASS__,'_excerpt_length') );


            add_filter('bs_blog_single_header_image',array(__CLASS__,'_change_image'));

            if(class_exists('WpbakeryShortcodeParams')){

                WpbakeryShortcodeParams::addField( 'add_social', array(__CLASS__,'add_social_param'), BravoAssets::url('js/vc_js.js') );

            }

            add_filter('get_the_archive_title',array(__CLASS__,'_change_archive_title'));
        }

        static function _change_archive_title($title)
        {
            if(is_search()){
                $title=sprintf(esc_html__("Search Result for: %s","medicool"),get_query_var('s'));
            }
            return $title;
        }
        static function add_social_param($settings, $value)
        {
            $val = $value;
            $html = '<div class="st_add_social">';

            parse_str(urldecode($value), $social);

            if(is_array($social))
            {
                $i = 1;
                foreach ($social as $key => $value) {
                    if(!isset($value['url'])) $value['url'] = '';
                    $html .= '<div class="social-item" data-item="'.esc_attr($i).'">';
                    $html .= '<label>Social '.esc_attr($i).':</label></br><label>Icon </label><input style="width:65%;margin-right:10px;margin-bottom:15px" class="st-social st_iconpicker" name="'.esc_attr($i).'[social]" value="'.esc_attr($value['social']).'" type="text" ></br>';
                    $html .= '<label>Link </label><input class="st-social" name="'.esc_attr($i).'[url]" value="'.esc_attr($value['url']).'" type="text" >';
                    $html .= '<a  href="#" class="st-del-item">Delete</a>';
                    $html .= '</div>';
                    $i++;
                }
            }
            $html .= '</div>';
            $html .= '<div class="st-add"><button class="vc_btn vc_btn-primary vc_btn-sm st-button-add" type="button">'.esc_html__('Add social', "medicool").' </button></div>';
            $html .= '<input name="'.esc_attr($settings['param_name']).'" class="st-social-value wpb_vc_param_value wpb-textinput '.esc_attr($settings['param_name']).' '.esc_attr($settings['type']).'_field" type="hidden" value="'.esc_attr($val).'" >';
            return $html;
        }
        static function _change_image($src){
            if(is_singular()){
                if($meta=get_post_meta(get_the_ID(),'_header_image',true)){
                    $src=$meta;
                }
            }

            return $src;

        }
        static function _excerpt_length($length)
        {
            $length = 15;
            return bravo_get_option('post_exerpt_length',$length);
        }

        static function _st_blog_title($title)
        {
            if(is_archive()){
                $title=get_the_archive_title();
            }

            if(is_search()){
                $title= sprintf( esc_html__( 'Search Results for: %s', "medicool" ), get_search_query() );

            }
            return $title;
        }
        static function _home_page_header_img($image_src)
        {
            if (is_page_template('template-blank.php')) {
                $image_src = bravo_get_option('header_image', $image_src);
            }

            if (is_singular()) {
                if ($meta = get_post_meta(get_the_ID(), '_header_image', true)) {
                    $image_src = $meta;
                }
            }

            return $image_src;
        }

        static function _add_body_class($class)
        {
            $menu = bravo_get_option('menu_width_fullwidth', 'on');
            if (is_singular()) {
                $meta = get_post_meta(get_the_ID(), 'menu_width_fullwidth', true);
                if ($meta) $menu = $meta;
            }

            $transparent_header = bravo_get_option('transparent_header', 'off');
            if (is_singular() and get_post_meta(get_the_ID(), 'custom_header_style', true) == 'on') {
                $meta = get_post_meta(get_the_ID(), 'transparent_header', true);
                if ($meta) $transparent_header = $meta;
            }

            if ($transparent_header == 'on') {
                $class[] = 'header_transparent';
            }

            if ($menu == 'on')
                $class[] = 'bravo_fullwidth_menu';
            else
                $class[] = 'bravo_boxed_menu';


            $class[] = 'woocommerce';

			if(bravo_get_option('gen_enable_preload')=='on'){
				$class[]='gen_enable_preload';
			}


            $positionMenu = bravo_menu_pos();
            $class[]=$positionMenu.'-menu';

            return $class;
        }

        static function _show_custom_css()
        {



            $style = BravoTemplate::load_view('custom_css');

            wp_add_inline_style( 'bravo_custom', $style );
            wp_add_inline_style( 'bravo_custom', bravo_get_option('style_custom_css') );

        }

        static function _add_breadcrumb()
        {
            get_template_part('bc');
        }

        static function _init_elements()
        {

        }

        static function _blog_filter_sidebar($sidebar)
        {
            if(is_singular('post') or is_singular('page') or is_page_template('template-blogs.php')){
                $pos = bravo_get_option('page_sidebar_pos', 'right');
                $sidebar_id = bravo_get_option('page_sidebar_id', 'blog-sidebar');

                /// ID Meta ///
                if (is_singular()) {
                    $sidebar_id = bravo_get_option('page_single_sidebar_id', 'blog-sidebar');
                    if ($meta = get_post_meta(get_the_ID(), 'sidebar_id', true)) {
                        $sidebar_id = $meta;
                    }
                }
                if ($sidebar_id) {
                    $sidebar['id'] = $sidebar_id;
                }

                /// position Meta///
                $sidebar['position'] = $pos;
                if (is_singular()) {
                    $sidebar['position']  = bravo_get_option('page_single_sidebar_pos', 'right');
                    if ($meta = get_post_meta(get_the_ID(), 'sidebar_pos', true)) {
                        $sidebar['position'] = $meta;
                    }
                }

                if (BravoInput::get('sidebar_pos')) {
                    $sidebar['position'] = BravoInput::get('sidebar_pos');
                }
                if (BravoInput::get('sidebar_id')) {
                    $sidebar['id'] = BravoInput::get('sidebar_id');
                }
            }

            return $sidebar;
        }

        static function _top_page()
        {
            echo BravoTemplate::load_view('top_page');
        }

        static function _add_scripts()
        {
            /*
             * Javascript
             * */
            wp_enqueue_script('bootstrap.min.js',BravoAssets::url('js/bootstrap.min.js'),array('jquery'),null,true);
            wp_enqueue_script('jquery.fancybox.pack',BravoAssets::url('js/jquery.fancybox.pack.js'),array('jquery'),null,true);

            wp_enqueue_script('owl.carousel.min',BravoAssets::url('js/owl.carousel.min.js'),array('jquery'),null,true);
            wp_enqueue_script('script',BravoAssets::url('js/script.js'),array('jquery'),null,true);
            wp_enqueue_script('bravo_custom',BravoAssets::url('js/custom.js'),array('jquery'),null,true);


            $gg_api_key  = bravo_get_option('bravo_google_api_key','AIzaSyA1l5FlclOzqDpkx5jSH5WBcC0XFkqmYOY');

            if (is_ssl()){
                $url=add_query_arg(array(
                    'v'=>'3', //v=3.exp
                    'signed_in'=>'true',
                    'libraries'=>'places',
                    'language'=>'en',
                    'sensor'=>'false',
                    'key'=> $gg_api_key
                ),'https://maps.googleapis.com/maps/api/js');
            }else {
                $url=add_query_arg(array(
                    'v'=>'3',
                    'signed_in'=>'true',
                    'libraries'=>'places',
                    'language'=>'en',
                    'sensor'=>'false',
                    'key'=> $gg_api_key
                ),'http://maps.googleapis.com/maps/api/js');

            }
            wp_enqueue_script('gmap-apiv3', $url, array('jquery'), null, true);

            wp_enqueue_script('gmapv3',BravoAssets::url('/js/gmap3.js'),array('jquery'),false,true);


            if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
            $data = array(
                'ajaxurl'   => esc_url(admin_url('admin-ajax.php')),
                'site_url'  => site_url(),
                'theme_url' => get_template_directory_uri(),
            );
            wp_localize_script('bootstrap.min.js', 'ajax_param', $data);
            wp_localize_script('jquery', 'bravo_params', array(
                'on_loading_text' => esc_html__("Loading ....", "medicool"),
                'loadmore_text'   => esc_html__('Load More', "medicool"),
                'ajax_url'        => esc_url(admin_url('admin-ajax.php')),
                'nomore_text'     => esc_html__('No More', "medicool")
            ));


            // Style
            add_editor_style();
            wp_enqueue_style('bs-main-style',get_template_directory_uri().'/style.css');

            wp_register_style('bootstrap',BravoAssets::url('css/bootstrap.css'));
            wp_register_style('font-awesome',BravoAssets::url('css/font-awesome.css'));
            wp_register_style('global',BravoAssets::url('css/global.css'));
            wp_register_style('jquery.fancybox',BravoAssets::url('css/jquery.fancybox.css'));
            wp_register_style("medicool",BravoAssets::url('css/medical.css'));
            wp_register_style('owl.carousel',BravoAssets::url('css/owl.carousel.css'));
            wp_register_style('owl.theme',BravoAssets::url('css/owl.theme.css'));
            wp_register_style('bravo_custom',BravoAssets::url('css/custom.css'));


            wp_enqueue_style('bootstrap');
            wp_enqueue_style('font-awesome');
            wp_enqueue_style('global');
            wp_enqueue_style('jquery.fancybox');
            wp_enqueue_style("medicool");
            wp_enqueue_style('owl.carousel');
            wp_enqueue_style('owl.theme');
            wp_enqueue_style('bravo_custom');


        }



        // -----------------------------------------------------
        // Default Hooked, Do not edit

        /**
         * Hook setup theme
         *
         *
         * */

        static function _after_setup_theme()
        {
            /*
             * Make theme available for translation.
             * Translations can be filed in the /languages/ directory.
             * If you're building a theme based on stframework, use a find and replace
             * to change $st_textdomain to the name of your theme in all the template files
             */

            // This theme uses wp_nav_menu() in one location.
            $menus = BravoConfig::get('nav_menus');
            if (is_array($menus) and !empty($menus)) {
                register_nav_menus($menus);
            }


            //Theme supports from config

            add_theme_support('automatic-feed-links');
            add_theme_support('post-thumbnails');
            add_theme_support('html5', array(
                'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
            ));
            add_theme_support('post-formats', array(
                'image', 'video', 'gallery', 'audio', 'quote'
            ));
            add_theme_support('woocommerce');
            add_theme_support('custom-header', array());
            add_theme_support('custom-background', array());
            add_theme_support('title-tag', array());

            if (!isset($content_width)) $content_width = 900;

        }

        /**
         * Add default sidebar to website
         *
         *
         * */
        static function _add_sidebars()
        {
            // From config file
            $sidebars = BravoConfig::get('sidebars');
            if (is_array($sidebars) and !empty($sidebars)) {
                foreach ($sidebars as $value) {
                    register_sidebar($value);
                }
            }

        }


        /**
         * Set up author data
         *
         * */
        static function _setup_author()
        {
            global $wp_query;

            if ($wp_query->is_author() && isset($wp_query->post)) {
                $GLOBALS['authordata'] = get_userdata($wp_query->post->post_author);
            }
        }


        /**
         * Hook to wp_title
         *
         * */
        static function _wp_title($title, $sep)
        {
            if (is_feed()) {
                return $title;
            }

            global $page, $paged;

            // Add the blog name
            $title .= get_bloginfo('name', 'display');

            // Add the blog description for the home/front page.
            $site_description = get_bloginfo('description', 'display');
            if ($site_description && (is_home() || is_front_page())) {
                $title .= " $sep $site_description";
            }

            // Add a page number if necessary:
            if (($paged >= 2 || $page >= 2) && !is_404()) {
                $title .= " $sep " . sprintf(esc_html__('Page %s', "medicool"), max($paged, $page));
            }

            return $title;
        }

        /**
         * Hook to add_custom_head
         *
         * */
        static function _add_custom_head()
        {
//            $adv_ga_code = bravo_get_option('adv_ga_code');
//            if (!empty($adv_ga_code)) {
//                echo balanceTags($adv_ga_code);
//            }

        }


        static function _change_favicon(){

        }


    }

    BravoGeneral::_init();
}