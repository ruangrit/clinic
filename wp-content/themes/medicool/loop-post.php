<div <?php post_class('item-box ')?>>
	<div class="pic">
		<?php
		if(has_post_thumbnail()){
			echo get_the_post_thumbnail(get_the_ID(),array(370,250),array('class'=>'img-responsive'));
		}else{
			echo '<div class="no_post_thumb"></div>';
		}
		?>
	</div>
	<div class="item-box-body">
		<h4 class="tt05"><a href="<?php the_permalink() ?>"><?php the_title() ?></a> </h4>
		<p class="postby"><?php esc_attr_e("Posted","medicool") ?>
			<span class="datetime"><?php echo get_the_time('j F Y') ?></span>
			<?php esc_attr_e("by","medicool") ?>
			<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>">
				<?php the_author(); ?>
			</a>
		</p>
		<div class="color-70"><?php the_excerpt() ?> <a href="<?php the_permalink() ?>">[<?php esc_html_e("Read more","medicool") ?>]</a></div>
	</div>
</div>