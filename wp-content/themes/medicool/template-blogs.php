<?php
/**
 * Template Name: Template Blog
 * Created by PhpStorm.
 * User: me664
 * Date: 2/28/15
 * Time: 10:48 PM
 */

get_header();
$sidebar=bravo_get_sidebar();
$sidebar_pos=$sidebar['position'];
$enable_head = bravo_get_option('enable_head_page');
$title = bravo_get_option('post_blog_title');
$bg = bravo_get_option('blog_background_image');
$enable_head_mt = get_post_meta(get_the_ID(),'enable_head_page',true);
if($enable_head_mt == 'on'){
	$title_mt = get_post_meta(get_the_ID(),'post_blog_title',true);
	$bg_mt = get_post_meta(get_the_ID(),'blog_background_image',true);
	$enable_head = $enable_head_mt;
	$title = $title_mt;
	$bg = $bg_mt;
}
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

$page = get_query_var('paged',1);
$number_of_row = get_post_meta(get_the_ID(),'page_blog_view',true);
if(empty($number_of_row)){
	$number_of_row = 4;
}
$query=array(
	'paged'=>$page,
	'post_type' => 'post',
);
query_posts($query);
?>
	<div class="primary-content">
		<div class="blog">
			<div class="container">
				<div class="row">
					<?php if($sidebar_pos=='left'){ get_sidebar(); }?>
					<div class="col-xs-12 <?php echo esc_html($sidebar_pos=='no'?'col-md-12':'col-md-8'); ?>">
						<div class="row grid-blog">
							<?php
							while(have_posts()){
								the_post();
								?>
								<div class="col-xs-12 col-sm-<?php echo esc_html($number_of_row) ?>">
									<?php echo get_template_part('loop','post'); ?>
								</div>
								<?php
							}
							?>
						</div>
						<?php echo bravo_paginate_links(); ?>
					</div>
					<?php if($sidebar_pos=='right'){ get_sidebar(); }?>
				</div>
			</div>
		</div>
		<!-- E: .blog -->
	</div>
<?php wp_reset_postdata(); ?>
<?php
get_footer();
