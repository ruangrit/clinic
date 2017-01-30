<?php
if(!class_exists("Bravo_List_Twitter_Widget")){
	class Bravo_List_Twitter_Widget extends WP_Widget {

		public function __construct(){

			parent::__construct( false, 'Bravo List Twitter' );

		}
		static function st_add_widget()
		{
			register_widget( __CLASS__ );
		}

		public function widget( $args, $instance ) {
			$instance=wp_parse_args($instance,array(
				'title'=>'',
				'user'=>'',
				'number'=>'',
				'consumer_key'=>'',
				'consumer_secret'=>'',
			));
			extract($instance);
			$output = "";
			if(empty($consumer_key)) $consumer_key = '18ihEuNsfOJokCLb8SAgA';
			if(empty($consumer_secret)) $consumer_secret = '7vTYnLYYiP4BhXvkMWtD3bGnysgiGqYlsPFfwXhGk';
			if($user)
			{
				// Set your personal data retrieved at https://dev.twitter.com/apps
				$credentials = array(
					'consumer_key' => $consumer_key,
					'consumer_secret' => $consumer_secret
				);
				$twitter_api = new Wp_Twitter_Api( $credentials );

				$query = 'count='.esc_attr($number).'&include_entities=true&include_rts=true&screen_name='.balanceTags($user);

				$twitters = $twitter_api->query( $query );



				if (!isset($twitters->errors) && count($twitters)>0) {
					$i=0;
					foreach( $twitters as $twitter ) {
						if($i < $number) {
							$output .= '
							<li>
								<p class="list-latest-desc">
								' . esc_html($twitter->text) . '
								</p>
								<p class="color-a8">' . human_time_diff( strtotime( $twitter->created_at ) ) . ' ago</p>
							</li>';
						}
						$i++;
					}
				}else{
					$output .= esc_html($twitters['errors'][0]['message']);
				}
			}

			?>
			<div class="widget latest-tweets">
				<div class="widget-title">
					<h4><?php echo esc_html($title) ?></h4>
				</div>
				<ul class="notype list-latest">
					<?php echo balanceTags($output) ?>
				</ul>
			</div>
			<?php
		}

		public function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = sanitize_text_field( $new_instance['title'] );
			$instance['user'] = sanitize_text_field( $new_instance['user'] );
			$instance['consumer_key'] = sanitize_text_field( $new_instance['consumer_key'] );
			$instance['consumer_secret'] = sanitize_text_field( $new_instance['consumer_secret'] );
			$instance['number'] = (int) $new_instance['number'];
			return $instance;
		}


		public function form( $instance ) {
			$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
			$user     = isset( $instance['user'] ) ? esc_attr( $instance['user'] ) : '';
			$consumer_key     = isset( $instance['consumer_key'] ) ? esc_attr( $instance['consumer_key'] ) : '';
			$consumer_secret     = isset( $instance['consumer_secret'] ) ? esc_attr( $instance['consumer_secret'] ) : '';
			$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;

			?>
			<p><label for="<?php echo esc_html($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:',"medicool" ); ?></label>
				<input class="widefat" id="<?php echo esc_html($this->get_field_id( 'title' )); ?>" name="<?php echo esc_html($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_html($title); ?>" /></p>

			<p><label for="<?php echo esc_html($this->get_field_id( 'user' )); ?>"><?php esc_html_e( 'User Twitter:',"medicool" ); ?></label>
				<input class="widefat" id="<?php echo esc_html($this->get_field_id( 'user' )); ?>" name="<?php echo esc_html($this->get_field_name( 'user' )); ?>" type="text" value="<?php echo esc_html($user); ?>" /></p>

			<p><label for="<?php echo esc_html($this->get_field_id( 'consumer_key' )); ?>"><?php esc_html_e( 'Consumer key:',"medicool" ); ?></label>
				<input class="widefat" id="<?php echo esc_html($this->get_field_id( 'consumer_key' )); ?>" name="<?php echo esc_html($this->get_field_name( 'consumer_key' )); ?>" type="text" value="<?php echo esc_html($consumer_key); ?>" /></p>

			<p><label for="<?php echo esc_html($this->get_field_id( 'consumer_secret' )); ?>"><?php esc_html_e( 'Consumer secret:',"medicool" ); ?></label>
				<input class="widefat" id="<?php echo esc_html($this->get_field_id( 'consumer_secret' )); ?>" name="<?php echo esc_html($this->get_field_name( 'consumer_secret' )); ?>" type="text" value="<?php echo esc_html($consumer_secret); ?>" /></p>


			<p><label for="<?php echo esc_html($this->get_field_id( 'number' )); ?>"><?php esc_html_e( 'Number:',"medicool" ); ?></label>
				<input class="tiny-text" id="<?php echo esc_html($this->get_field_id( 'number' )); ?>" name="<?php echo esc_html($this->get_field_name( 'number' )); ?>" type="number" step="1" min="1" value="<?php echo esc_html($number); ?>" size="3" /></p>


			<?php
		}

	}
	add_action( 'widgets_init', array('Bravo_List_Twitter_Widget','st_add_widget'));
}

