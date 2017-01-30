<?php
$sidebar=bravo_get_sidebar();
$sidebar_pos=$sidebar['position'];
get_header();
global $post;

$enable_head_departments = bravo_get_option('enable_head_gallery');
if($enable_head_departments == 'on'){
    $bg = bravo_get_option('head_gallery_image');
    $class = BravoAssets::build_css(' background: url("'.esc_url($bg).'") no-repeat fixed center center / cover ;')
    ?>
    <!-- Write code -->
    <section class="section-subbanner <?php echo esc_attr($class)?>">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="caption"><?php echo bravo_get_option('head_gallery_title') ?></div>
                    <?php get_template_part('bc'); ?>

                </div>
            </div>
        </div>
    </section>
    <!-- E: .section-banner -->
<?php } ?>

    <div class="primary-content single_gallery">
        <div class="gallery">
            <div class="container">
                <ul class="gallery-list row mb30 no-padding">
                    <?php
                    $data_gallery = get_post_meta(get_the_ID(),'gallery',true);
                    if(!empty($data_gallery)){
                        $data_gallery = explode(',',$data_gallery);
                        foreach($data_gallery as $k=>$v){
                            $url  = wp_get_attachment_image_url($v,'full');
                            ?>
                            <li class="col-md-4 col-sm-4 col-xs-12 gallery-list-image">
                                <div class="image-block">
                                    <img src="<?php echo esc_url($url) ?>">
                                    <a href="<?php echo esc_url($url) ?>" class="zoom bravo_list_gallery" data-fancybox-group="gallery1" rel="gallery1" title="gallery"><i class="fa fa-mail-forward"></i></a>
                                </div>
                            </li>
                            <?php
                        }
                    }
                    ?>

                </ul>
                <?php
                while(have_posts()){
                    the_post();
                    the_content();
                }
                ?>
            </div>
        </div>
    </div>
    <!-- E: .gallery -->


<?php
get_footer();
