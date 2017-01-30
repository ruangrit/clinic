<?php
$number_of_row = ceil(12/$number_of_row);
$query=array(
    'posts_per_page'=>$number,
    'post_type' => 'post',
    'order'=>$order,
    'orderby'=>$orderby,
);
$bravo_query = new WP_Query( $query );
?>
<div class="row">
    <?php
    while($bravo_query->have_posts()){
        $bravo_query->the_post();
        $link_image = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
        $icon = get_post_meta(get_the_ID() , 'featured_icon' , true);
        $post_author = get_post_field( 'post_author', get_the_ID() );
        $post_author = get_the_author_meta('nicename',$post_author);
        ?>
        <div class="col-xs-12 col-sm-<?php echo esc_attr($number_of_row) ?>">
            <div class="item-box">
                <div class="pic">
                    <img alt="<?php the_title() ?>" class="img-responsive" src="<?php echo esc_url($link_image) ?>">
                </div>
                <div class="item-box-body">
                    <h4 class="tt05"><a href="<?php the_permalink() ?>"><?php the_title() ?></a> </h4>
                    <p class="postby">
                        <?php esc_attr_e("Posted","medicool") ?>
                        <span class="datetime"><?php echo get_the_time('j F Y') ?></span>
                        <?php esc_attr_e("by","medicool") ?>
                        <span class="datetime"><?php echo get_the_author() ?></span>
                    </p>
                    <div class="color-70">
                        <?php the_excerpt() ?>
                        <a href="<?php the_permalink() ?>">[<?php esc_attr_e("Read more","medicool") ?>]</a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<?php wp_reset_postdata(); ?>