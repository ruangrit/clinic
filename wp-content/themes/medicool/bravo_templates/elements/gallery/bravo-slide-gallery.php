<?php
$query=array(
    'posts_per_page'=>$number,
    'post_type' => 'bravo_gallery',
    'order'=>$order,
    'orderby'=>$orderby,
);
$check = (explode(",",$bravo_gallery));
if($bravo_gallery != "_0_" and !in_array('_0_',$check) and !empty($bravo_gallery))
{
    $query['tax_query'][]=array(
        'taxonomy'=>'bravo_gallery_cat',
        'field'  =>'slug',
        'terms'=>explode(",",$bravo_gallery)
    );
}
$bravo_query = new WP_Query( $query );
?>
<section class="section-gallery v<?php echo esc_html($style) ?>">
    <div id="owl-demo" class="owl-carousel owl-theme owl-slide-gallery v<?php echo esc_html($style) ?>">
        <?php
        while($bravo_query->have_posts()){
            $bravo_query->the_post();
            ?>
            <?php $link_image = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())) ?>
            <?php if($style == '1'){ ?>
                <div class="item">
                    <img src="<?php echo esc_url($link_image)?>" alt="<?php the_title() ?>">
                    <div class="overlay">
                        <a href="<?php the_permalink() ?>" class="readmore"><i class="fa fa-link"></i> </a>
                        <a href="<?php the_permalink() ?>" class="quickview"><i class="fa fa-search"></i> </a>
                    </div>
                </div>
            <?php } ?>
            <?php if($style == '2'){ ?>
                <div class="item">
                    <img src="<?php echo esc_url($link_image)?>" alt="<?php the_title() ?>">
                    <div class="overlay">
                        <div class="inner">
                            <div class="overlay-content">
                                <div class="overlay-content-cell">
                                    <h5 class="tt05"><a href="<?php the_permalink() ?>"><?php the_title() ?></a> </h5>
                                    <div class="mb30"><?php the_excerpt() ?></div>
                                    <?php
                                    $social = get_post_meta(get_the_ID() , 'social' , true);
                                    if(!empty($social)){
                                      ?>
                                        <div class="social-links">
                                            <?php foreach($social as $k=>$v){ ?>
                                                <div class="icon">
                                                    <a href="<?php echo esc_url($v['link']) ?>" target="_blank" class="social-link-facebook"><i class="fa <?php echo esc_html($v['icon']) ?>"></i></a>
                                                </div>
                                            <?php } ?>

                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

        <?php
        }
        ?>
    </div>
    <?php
    if($show_control == "yes"){
        $link  = vc_build_link( $link_view_all );
        $html_link  = '<a href="'.esc_url($link['url']).'">'.esc_html($link['title']).'</a>';
        ?>
        <div class="controls">
            <h5 class="tt05"><?php echo sprintf(esc_html__("Please click on button arrow in order to view more or %s photo gallery","medicool"),$html_link) ?></h5>
        </div>
    <?php
    }
    ?>
</section>
<?php wp_reset_postdata(); ?>