<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 3/1/15
 * Time: 6:18 PM
 */
get_header();
global $post;
$author_id = $post->post_author;
$sidebar=bravo_get_sidebar();
$sidebar_pos=$sidebar['position'];
$enable_head = bravo_get_option('enable_head_page');
$title = bravo_get_option('post_blog_title');
$bg = bravo_get_option('blog_background_image');

if($enable_head == 'on'){
    $class = BravoAssets::build_css(' background: url("'.esc_url($bg).'") no-repeat fixed center center / cover ;')
    ?>
    <!-- Write code -->
    <section class="section-subbanner <?php echo esc_attr($class)?>">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="caption"><?php echo esc_html($title) ?></div>
                    <?php get_template_part('bc'); ?>

                </div>
            </div>
        </div>
    </section>
    <!-- E: .section-banner -->
<?php
}else{
    echo '<div class="no_banner"></div>';
} ?>

<?php
while(have_posts()){
    the_post();

    ?>
    <div class="primary-content">
        <div class="blog-columns">
            <div class="container">
                <div class="row">
                    <?php if($sidebar_pos=='left'){ get_sidebar(); }?>
                    <div class="col-xs-12 <?php echo esc_html($sidebar_pos=='no'?'col-md-12':'col-md-8'); ?>">
                        <div class="blog blogpost">
                            <article class="type-post">
                                <div class="entry-author">
                                    <div class="media">
                                        <div class="media-left pull-left">
                                            <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>">
                                                <?php echo get_avatar($author_id,70,'','',array('class'=>'media-object')) ?>
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <div class="media-content">
                                                <h4 class="media-heading"><?php echo get_post_meta(get_the_ID(),'author_name',true); ?></h4>
                                                <p class="postago">
                                                    <?php esc_attr_e("Posted","medicool") ?>
                                                    <span class="color-333">
                                                        <?php echo get_the_time(get_option('date_format')) ?>
                                                    </span>
                                                    <?php esc_attr_e("by","medicool") ?>
                                                    <span class="color-333">
                                                        <a class="color-333" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>">
                                                            <?php the_author(); ?>
                                                        </a>
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="entry-title">
                                    <h3><?php the_title() ?></h3>
                                </div>
                                <?php  get_template_part('post-format')?>
                                <div class="entry-content">
                                   <?php
                                   the_content();
                                    wp_link_pages( array(
                                        'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', "medicool" ) . '</span>',
                                        'after'       => '</div>',
                                        'link_before' => '<span>',
                                        'link_after'  => '</span>',
                                        'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', "medicool" ) . ' </span>%',
                                        'separator'   => '<span class="">, </span>',
                                    ) );
                                   ?>
                                </div>
                                <div>
                                    <?php the_tags() ?>
                                </div>
                                <div>
                                    <?php esc_html_e('Categories: ',"medicool") ?>
                                    <?php the_category(', ') ?>
                                </div>
                                <?php get_template_part('share'); ?>
                            </article>
                            <!-- E: article.type-post -->
                            <?php
                            if(comments_open()){
                                comments_template();
                            }?>
                            <!-- E: .comment-form -->
                        </div>
                    </div>
                    <?php if($sidebar_pos=='right'){ get_sidebar(); }?>

                </div>
            </div>
        </div>
        <!-- E: . -->
    </div>
    <?php

}
get_footer();