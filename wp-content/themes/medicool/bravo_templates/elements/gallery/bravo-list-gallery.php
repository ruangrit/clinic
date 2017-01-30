<?php
$page = get_query_var('paged',1);
$query=array(
    'posts_per_page'=>$number,
    'paged'=>$page,
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
query_posts($query);
global $wp_query;
$number_of_row = ceil(12/$number_of_row);
?>
<div class="primary-content">
    <div class="gallery">
        <div class="container">
            <ul class="gallery-list no-padding row">
                <?php
                while(have_posts()){
                    the_post();
                    ?>
                    <?php $link_image = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())) ?>
                    <li class="col-md-<?php echo esc_html($number_of_row) ?> col-sm-<?php echo esc_html($number_of_row) ?> col-xs-12">
                        <div class="image-block">
                            <img src="<?php echo esc_url($link_image) ?>" alt="gallery">
                            <a href="<?php the_permalink() ?>" class="zoom" title="gallery">
                                <i class="fa fa-mail-forward"></i>
                            </a>
                        </div>
                        <div class="gallery-head">
                            <h4 class="title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
                            <div class="gallery-head-desc">
                                <span class="calendar">
                                    <i class="fa fa-calendar"></i> <?php echo get_the_time('j F Y') ?></span>
                                <span class="tag">
                                    <i class="fa fa-tags"></i>
                                    <?php
                                    $data =  get_the_terms(get_the_ID(),'bravo_gallery_cat');
                                    $txt = "";
                                    if(!empty($data)){
                                        foreach($data as $k=>$v){
                                            $link = $category = get_term_link( $v->name, 'bravo_gallery_cat' );
                                            $txt .=  " <a href=".esc_url($link)." >".esc_html($v->name)."</a>,";
                                        }
                                        $txt = substr($txt,0,-1);
                                    }
                                    echo balanceTags($txt);
                                    ?>

                                </span>
                            </div>
                        </div>
                    </li>
                    <?php
                }
                ?>
            </ul>
            <?php if($show_pagination == 'on'){ ?>
                <?php echo bravo_paginate_links(); ?>
            <?php } ?>
        </div>
    </div>
</div>
<?php wp_reset_postdata(); ?>