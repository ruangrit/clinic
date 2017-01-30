<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 2/25/15
 * Time: 9:20 PM
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <div class="wrapper <?php echo bravo_get_wrapper_version(); ?>">

        <div class="navbar navbar-main">
            <?php
            global $post;
            $top_left = bravo_get_option('top_bar_left');
            $top_right = bravo_get_option('top_bar_right');

            $mt_cusstom_top = get_post_meta(get_the_ID(),'st_custom_top_bar',true);
            if($mt_cusstom_top == 'on'){
                $top_left = get_post_meta(get_the_ID(),'top_bar_left',true);
                $top_right = get_post_meta(get_the_ID(),'top_bar_right',true);
            }
            if(!empty($top_left) or !empty($top_right)){
            ?>
                <div class="topbar grayee">
                    <div class="container">
                        <div class="row">
                            <div class="hidden-xs hidden-sm col-md-9">
                                <div class="info">
                                    <?php echo balanceTags($top_left) ?>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <?php echo balanceTags($top_right) ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="container container-nav">
                <div>
                    <p>Custom heading here</p>
                    <div class="social-links">
                        <?php
                        $social =  bravo_get_option('footer_social');
                        if(!empty($social)){
                            foreach($social as $k=>$v){
                                $class = BravoAssets::build_css('border-color:'.esc_attr($v['color']).' !important ; color:'.esc_url($v['color']).' !important ; opacity: 0.8;');
                                $class .= " ".BravoAssets::build_css('opacity: 1;',":hover");
                                ?>
                                <div class="icon">
                                    <a class="social-link-facebook <?php  echo esc_attr($class)?>" target="_blank" href="#"><i class="fa <?php  echo esc_attr($class)?> <?php echo esc_attr($v['icon']) ?>"></i></a>
                                </div>
                        <?php
                            }
                        }
                        ?>

                    </div>
                    <div class="telephone">
                        <a href="tel:+66877322575">0877322575</a>
                    </div>
                </div>
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="<?php echo esc_url(home_url('/')) ?>" class="navbar-brand">
                        <?php if(bravo_get_url_logo()){?>
                            <img alt="<?php esc_html_e('Logo',"medicool")?>" src="<?php echo esc_url(bravo_get_url_logo());?>" />
                        <?php }else{
                            ?>
                            <h1><?php echo esc_html(bloginfo('title')); ?></h1>
                        <?php
                        } ?>
                    </a>
                </div>
                <ul class="info-toggle">
                    <?php
                    $enable_search_menu = bravo_get_option('enable_search_menu');
                    $mt_enable_search_menu = get_post_meta(get_the_ID(),'custom_enable_search_menu',true);
                    if($mt_enable_search_menu != ''){
                        $enable_search_menu =  get_post_meta(get_the_ID(),'extra_menu',true);
                    }
                    if($enable_search_menu == 'on'){?>
                        <li class="nav-item">
                            <a href="#" class="btn_search_menu"><i class="fa fa-search"></i></a>
                            <div class="hidden_menu_search">
                                <?php echo get_template_part('searchform'); ?>
                            </div>

                        </li>
                    <?php } ?>

                    <?php
                    $extra_menu = bravo_get_option('extra_menu');
                    $mt_custom_extra_menu = get_post_meta(get_the_ID(),'custom_extra_menu',true);
                    if($mt_custom_extra_menu == 'on'){
                        $extra_menu =  get_post_meta(get_the_ID(),'extra_menu',true);
                    }
                    if(!empty($extra_menu)){
                   ?>
                    <li class="nav-item dropdown">
                        <a href="#" class="dropdown-toggle btn_extra_menu" data-toggle="dropdown" data-hover="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bars"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <?php
                            foreach($extra_menu as $k=>$v){
                                echo "<li>";
                                echo do_shortcode($v['content']);
                                echo "</li>";
                            }
                            ?>
                        </ul>
                    </li>
                    <?php  }  ?>
                </ul>
                <!-- =========================
                         END  EXTRA MENU
                ============================== -->
                <nav class="navbar-collapse collapse middle-menu">
                    <?php
                    if(has_nav_menu('primary')){
                        $args = array(
                            'theme_location'  => 'primary',
                            'menu_class'      => 'nav navbar-nav menu-main navbar-right',
                            'container'=>'',
                            'walker'          => new Bravo_Menu_Walker,
                        );
                        wp_nav_menu($args);
                    }
                    ?>
                </nav>

            </div>
        </div>
        <!-- End header -->

        <!-- Begin Main -->
        <div id="main" class="content-main"><!-- begin content-mainn -->
            <div class="content-article"><!-- begin content-article -->


