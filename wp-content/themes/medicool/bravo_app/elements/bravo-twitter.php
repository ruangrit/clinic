<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 12/18/15
 * Time: 9:16 PM
 */
add_filter( 'https_ssl_verify', '__return_false' );
add_filter( 'https_local_ssl_verify', '__return_false' );
if (!function_exists('bravo_twitter_func')) {
	function bravo_twitter_func($attr, $content = false)
	{

		$data = shortcode_atts(array(
			'title' => '',
			'twitter_number' => '',
			'twitter_user'  => '',
			'consumer_key'  => '',
			'consumer_secret'  => '',
		), $attr,'bravo_twitter');
		extract($data);

		$output = "";
        if(empty($consumer_key)) $consumer_key = '18ihEuNsfOJokCLb8SAgA';
        if(empty($consumer_secret)) $consumer_secret = '7vTYnLYYiP4BhXvkMWtD3bGnysgiGqYlsPFfwXhGk';
		if($twitter_user)
		{
			$user = $twitter_user;
			$number  = $twitter_number;
			// Set your personal data retrieved at https://dev.twitter.com/apps
			$credentials = array(
				'consumer_key' => $consumer_key,
				'consumer_secret' => $consumer_secret
			);
			$twitter_api = new Wp_Twitter_Api( $credentials );

			$query = 'count='.esc_attr($number).'&include_entities=true&include_rts=true&screen_name='.esc_html($user);

			$twitters = $twitter_api->query( $query );

			if (!isset($twitters->errors) && count($twitters)>0) {
				$i=0;
				foreach( $twitters as $twitter ) {
					if($i < $twitter_number){

					    $text = bravo_cutnchar($twitter->text,50);
						$output.='<div class="link-twitter">
									<span class="set-twitter">
										<i class="fa fa-twitter"></i>
									</span>
									<p>
									'.do_shortcode($text).'
									</p>
									'.human_time_diff(strtotime($twitter->created_at) ) .' ago
								</div>';
					}
					$i++;
				}
			}
		}

		return '
		<div class="widget">
			<h3>'.esc_html($title).'</h3>
			'.do_shortcode($output).'
		</div>
		';
	}

	bravo_reg_shortcode('bravo_twitter', 'bravo_twitter_func');

	vc_map(array(
		"name"     => esc_html__("Bravo Twitter", "medicool"),
		"base"     => "bravo_twitter",
		"category" => "CMSBlueTheme",
		"params"   => array(
			array(
				"type" => "textfield",
				"heading" => esc_html__("Title", "medicool"),
				"param_name" => "title",
				"description" =>"",
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Number", "medicool"),
				"param_name" => "twitter_number",
				"description" =>"",
			),
            array(
				"type" => "textfield",
				"heading" => esc_html__("Consumer Key", "medicool"),
				"param_name" => "consumer_key",
				"description" =>"",
			),
            array(
				"type" => "textfield",
				"heading" => esc_html__("Consumer Secret", "medicool"),
				"param_name" => "consumer_secret",
				"description" =>"",
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("User Twitter", "medicool"),
				"param_name" => "twitter_user",
				"description" => ""
			),

		)
	));
}