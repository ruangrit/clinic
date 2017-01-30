<?php
$sidebar=bravo_get_sidebar();
$sidebar_pos=$sidebar['position'];
get_header();
global $post;

$enable_head_departments = bravo_get_option('enable_head_departments');
if($enable_head_departments == 'on'){
    $bg = bravo_get_option('head_departments_image');
    $class = BravoAssets::build_css(' background: url("'.esc_url($bg).'") no-repeat fixed center center / cover ;')
    ?>
    <!-- Write code -->
    <section class="section-subbanner <?php echo esc_attr($class)?>">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="caption"><?php echo bravo_get_option('head_departments_title') ?></div>
                    <?php get_template_part('bc'); ?>

                </div>
            </div>
        </div>
    </section>
    <!-- E: .section-banner -->
<?php } ?>
    <div class="primary-content">
        <div class="service-single">
            <div class="container">
                <div class="row">
                    <?php if($sidebar_pos=='left'){ get_sidebar(); }?>
                    <div class="<?php echo esc_html($sidebar_pos=='no'?'col-md-12':'col-md-8'); ?> col-xs-12 col-sm-12">
                        <div class="service-detail">
                            <?php if(has_post_thumbnail()) { ?>
                                <p><?php the_post_thumbnail('full',array('class'=>"img-responsive")); ?></p>
                            <?php } ?>
                            <?php
                            while(have_posts()){
                                the_post();
                                the_content();
                            }
                            ?>
                        </div>
                    </div>
                    <?php if($sidebar_pos=='left'){ get_sidebar(); }?>
                </div>
            </div>
        </div>
        <!-- E: . -->
    </div>
<?php
get_footer();
