<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 2/25/15
 * Time: 9:20 PM
 */
$sidebar=bravo_get_sidebar();
$sidebar_pos=$sidebar['position'];
global $wp_query;
get_header();
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
								<div class="col-xs-12 col-sm-6 list-blog-col-6">
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
    <?php
get_footer();