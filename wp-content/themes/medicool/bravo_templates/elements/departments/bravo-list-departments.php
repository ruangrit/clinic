<?php
$number_of_row = ceil(12/$number_of_row);
$query=array(
    'posts_per_page'=>$number,
    'post_type' => 'bravo_departments',
    'order'=>$order,
    'orderby'=>$orderby,
);
$check = (explode(",",$bravo_departments_cat));
if($bravo_departments_cat != "_0_" and !in_array('_0_',$check) and !empty($bravo_departments_cat))
{
    $query['tax_query'][]=array(
        'taxonomy'=>'bravo_departments_cat',
        'field'  =>'slug',
        'terms'=>explode(",",$bravo_departments_cat)
    );
}
$bravo_query = new WP_Query( $query );
?>
<?php if($style == '1'){ ?>
    <ul class="notype group-list-department row list_departments_v1">
        <?php
        while($bravo_query->have_posts()){
            $bravo_query->the_post();


            $icon = get_post_meta(get_the_ID() , 'featured_icon' , true);
            ?>
            <li class="col-xs-6 col-sm-<?php echo esc_attr($number_of_row) ?>">
                <a href="#">
                    <span class="<?php echo esc_attr($icon) ?> fs1"></span><br>
                    <span class="department-name"><?php the_title() ?></span>

                    <?php echo get_the_post_thumbnail(get_the_ID(),array(360,250),array('class'=>'img-responsive')); ?>
                </a>
            </li>
        <?php } ?>
    </ul>
<?php } ?>
<?php if($style == '2'){ ?>
    <div class="row list_departments_v2">
        <?php
        while($bravo_query->have_posts()){
            $bravo_query->the_post();
            $link_image = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
            $icon = get_post_meta(get_the_ID() , 'featured_icon' , true);
            ?>
            <div class="col-sm-6 col-md-<?php echo esc_attr($number_of_row) ?>">
                <div class="department">
                    <div class="depart-image">
                        <div class="pic">
                            <img src="<?php echo esc_url($link_image) ?>" class="img-responsive" alt="<?php the_title() ?>">
                        </div>
                    <span class="corner">
                        <span class="<?php echo esc_attr($icon) ?> fs1"></span>
                    </span>
                    </div>
                    <div class="department-body">
                        <h4 class="tt05"><a href="<?php the_permalink() ?>"><?php the_title() ?></a> </h4>
                        <div class="color-70"><?php the_excerpt() ?></div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
<?php } ?>
<?php if($style == '3'){ ?>
    <div class="row list_departments_v3">
        <?php
        while($bravo_query->have_posts()){
            $bravo_query->the_post();
            $link_image = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
            $icon = get_post_meta(get_the_ID() , 'featured_icon' , true);
            ?>
            <div class="col-xs-12 col-sm-<?php echo esc_attr($number_of_row) ?>">
                <div class="item-box mb60">
                    <div class="pic">
                        <a href="<?php the_permalink() ?>"><img src="<?php echo esc_url($link_image) ?>" class="img-responsive" alt="<?php the_title() ?>"></a>
                    </div>
                    <div class="weare-content">
                        <div class="choose">
                            <div class="choose-icon">
                                <span class="<?php echo esc_attr($icon) ?> fs1"></span>
                            </div>
                            <div class="choose-content">
                                <h3 class="service-title"><?php the_title() ?></h3>
                                <div class="color-70"><?php the_excerpt() ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
<?php } ?>
<?php if($style == '4'){ ?>
    <div class="row list_departments_v3">
        <?php
        while($bravo_query->have_posts()){
            $bravo_query->the_post();
            $link_image = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
            $icon = get_post_meta(get_the_ID() , 'featured_icon' , true);
            ?>
            <div class="col-xs-12 col-sm-<?php echo esc_attr($number_of_row) ?>">
                <div class="service-grid-item grayee">
                    <div class="weare-content">
                        <div class="choose">
                            <div class="choose-icon">
                                <span class="<?php echo esc_attr($icon) ?> fs1"></span>
                            </div>
                            <div class="choose-content">
                                <h3 class="service-title"><?php the_title() ?></h3>
                                <div class="color-70"><?php the_excerpt() ?></div>
                                <p><a href="<?php the_permalink() ?>" class="view-detail"><?php esc_html_e("View Detail","medicool") ?> <i class="fa fa-angle-double-right"></i></a> </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
<?php } ?>

<?php wp_reset_postdata(); ?>
