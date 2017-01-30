<?php
get_header();
$sidebar=bravo_get_sidebar();
while(have_posts()){
    the_post();
    ?>
	<div class="row">
	<div class="single-page ">
		<div class="section-content bg-pattern dark-screen">
			<div class="container clearfix">
				<?php if($sidebar['position']=='left') get_sidebar(); ?>
				<div class="col-xs-12 <?php echo esc_html($sidebar['position']=='no'?'col-md-12':'col-md-8'); ?>">
					<div <?php post_class('blog-layout-single')?>>
						<div class="blog blogpost">
							<article class="type-post">
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
								<?php get_template_part('share'); ?>
							</article>
							<?php
							if(comments_open()){
								comments_template();
							}?>
						</div>
					</div>
				</div>
				<?php if($sidebar['position']=='right') get_sidebar(); ?>
			</div>
		</div>
	</div>
    <!-- BLOG PAGE TITLE -->
	</div>


<?php

}
get_footer();