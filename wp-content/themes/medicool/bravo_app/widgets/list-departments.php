<?php
if(!class_exists('Bravo_List_Departments_Widget')){
	class Bravo_List_Departments_Widget extends WP_Widget{
		public function __construct(){

			parent::__construct( false, 'Bravo List Departments' );

		}
		static function st_add_widget()
		{
			register_widget( __CLASS__ );
		}
		public function widget( $args, $instance ) {

			$instance=wp_parse_args($instance,array(
				'title'=>'',
				'number'=>'',
				'order'=>'asc',
				'order_by'=>'none'
			));
			extract($instance);
			$title = apply_filters( 'widget_title', $instance['title'] );
			echo ($args['before_widget']);
			if ( ! empty( $title ) ) {
				echo ($args['before_title'] . $title . $args['after_title']);
			}
			$query=array(
				'posts_per_page'=>$number,
				'post_type' => 'bravo_departments',
				'order'=>$order,
				'orderby'=>$order_by,
			);
			$bravo_query = new WP_Query( $query );
			echo "<ul class=\" single-service otype group-list-department row\">";
			while($bravo_query->have_posts()) {
				$bravo_query->the_post();
				$link_image = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
				$icon       = get_post_meta( get_the_ID() , 'featured_icon' , true );
				?>
					<li class="col-xs-6">
						<a href="#">
							<span class="<?php echo esc_html($icon) ?> fs1"></span><br>
							<span class="department-name"><?php the_title() ?></span>
							<img alt="<?php the_title() ?>" class="img-responsive" src="<?php echo esc_url($link_image) ?>">
						</a>
					</li>
				<?php
			}
			echo "</ul>";
			echo ($args['after_widget']);
		}
		public function form( $instance ) {
			$instance=wp_parse_args($instance,array(
				'title'=>'',
				'number'=>'',
				'order'=>'asc',
				'order_by'=>'none'
			));
			extract($instance);
			?>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:',"medicool" ); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php esc_html_e( 'Number:',"medicool" ); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="text" value="<?php echo esc_attr( $number ); ?>">
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'order' )); ?>"><?php esc_html_e( 'Order:',"medicool" ); ?></label>
				<select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'order' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'order' )); ?>"  >
					<option <?php selected('asc',$order) ?> value="asc" class="asc"><?php esc_attr_e("Asc","medicool") ?></option>
					<option <?php selected('desc',$order) ?> value="desc" class="desc"><?php esc_attr_e("Desc","medicool") ?></option>
				</select>
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'order_by' )); ?>"><?php esc_html_e( 'Order By:',"medicool" ); ?></label>
				<select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'order_by' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'order_by' )); ?>"  >
					<option <?php selected('none',$order_by) ?> value="none" class="none"><?php esc_html_e("None","medicool") ?></option>
					<option <?php selected('ID',$order_by) ?> value="ID" class="ID"><?php esc_html_e("ID","medicool") ?></option>
					<option <?php selected('author',$order_by) ?> value="author" class="author"><?php esc_html_e("Author","medicool") ?></option>
					<option <?php selected('title',$order_by) ?> value="title" class="title"><?php esc_html_e("Title","medicool") ?></option>
					<option <?php selected('name',$order_by) ?> value="name" class="name"><?php esc_html_e("Name","medicool") ?></option>
					<option <?php selected('type',$order_by) ?> value="type" class="type"><?php esc_html_e("Type","medicool") ?></option>
					<option <?php selected('date',$order_by) ?> value="date" class="date"><?php esc_html_e("Date","medicool") ?></option>
					<option <?php selected('modified',$order_by) ?> value="modified" class="modified"><?php esc_html_e("Modified","medicool") ?></option>
					<option <?php selected('parent',$order_by) ?> value="parent" class="parent"><?php esc_html_e("Parent","medicool") ?></option>
					<option <?php selected('rand',$order_by) ?> value="rand" class="rand"><?php esc_html_e("Rand","medicool") ?></option>
					<option <?php selected('comment_count',$order_by) ?> value="comment_count" class="comment_count"><?php esc_html_e("Comment Count","medicool") ?></option>
				</select>
			</p>
			<?php
		}
		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['user_id'] = ( ! empty( $new_instance['user_id'] ) ) ? strip_tags( $new_instance['user_id'] ) : '';
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['number'] = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '';
			$instance['order'] = ( ! empty( $new_instance['order'] ) ) ? strip_tags( $new_instance['order'] ) : '';
			$instance['order_by'] = ( ! empty( $new_instance['order_by'] ) ) ? strip_tags( $new_instance['order_by'] ) : '';

			return $instance;
		}
	}
	add_action( 'widgets_init', array('Bravo_List_Departments_Widget','st_add_widget'));
}


