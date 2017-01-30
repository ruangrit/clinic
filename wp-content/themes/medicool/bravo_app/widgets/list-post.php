<?php
if(!class_exists("Bravo_Recent_Posts_Widget")){
	class Bravo_Recent_Posts_Widget extends WP_Widget {

		public function __construct(){

			parent::__construct( false, 'Bravo Recent Posts' );

		}
		static function st_add_widget()
		{
			register_widget( __CLASS__ );
		}

		public function widget( $args, $instance ) {
			if ( ! isset( $args['widget_id'] ) ) {
				$args['widget_id'] = $this->id;
			}

			$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Bravo Recent Posts' ,"medicool");


			$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

			$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
			if ( ! $number )
				$number = 5;
			$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

			$r = new WP_Query( array(
				'posts_per_page'      => $number,
				'no_found_rows'       => true,
				'post_status'         => 'publish',
				'ignore_sticky_posts' => true
			) );

			if ($r->have_posts()) :
				?>
				<div class="widget recent-post">
					<div class="widget-title">

						<?php if ( $title ) {
							echo balanceTags($args['before_title'] . $title . $args['after_title']);
						} ?>
					</div>
					<div class="widget-body">
						<?php while ( $r->have_posts() ) : $r->the_post();

							?>
							<div class="media">
								<div class="media-left pull-left">
									<?php
									if(has_post_thumbnail()){
										$link_image = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
									?>
										<a href="<?php the_permalink() ?>">
											<img alt="<?php the_title() ?>" class="media-object" src="<?php echo esc_url($link_image) ?>">
										</a>
									<?php } ?>
								</div>
								<div class="media-body">
									<h4 class="media-heading"><a href="<?php the_permalink() ?>"><?php the_title() ?></a> </h4>
									<?php if ( $show_date ) : ?>
										<p class="postago">
											<?php esc_attr_e("Posted","medicool") ?>
											<span class="color-333"><?php echo get_the_time('j F Y') ?></span>
											<?php esc_attr_e("by","medicool") ?>
											<span class="color-333">
												<a class="color-333" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>">
													<?php the_author(); ?>
												</a>
											</span>

										</p>
									<?php endif; ?>

								</div>
							</div>
						<?php endwhile; ?>
					</div>
				</div>
				<?php
				// Reset the global $the_post as this query will have stomped on it
				wp_reset_postdata();

			endif;
		}

		public function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = sanitize_text_field( $new_instance['title'] );
			$instance['number'] = (int) $new_instance['number'];
			$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
			return $instance;
		}


		public function form( $instance ) {
			$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
			$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
			$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
			?>
			<p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:',"medicool" ); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_html($title); ?>" /></p>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'number' )) ?>"><?php esc_html_e( 'Number of posts to show:',"medicool" ); ?></label>
				<input class="tiny-text" id="<?php echo esc_html($this->get_field_id( 'number' )); ?>" name="<?php echo esc_html($this->get_field_name( 'number' )); ?>" type="number" step="1" min="1" value="<?php echo esc_html($number); ?>" size="3" /></p>

			<p><input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo esc_html($this->get_field_id( 'show_date' )); ?>" name="<?php echo esc_html($this->get_field_name( 'show_date' )); ?>" />
				<label for="<?php echo esc_html($this->get_field_id( 'show_date' )); ?>"><?php esc_html_e( 'Display post date?',"medicool" ); ?></label></p>
			<?php
		}

	}
	add_action( 'widgets_init', array('Bravo_Recent_Posts_Widget','st_add_widget'));
}

