<?php
if(!function_exists('bravo_slide_carousel')) {
	vc_map( array(
		"name"     => esc_html__("Bravo Testimonial", "medicool"),
		"base"     => "bravo_testimonial",
		"as_parent" => array('only' => 'bravo_testimonial_item'),
		"content_element" => true,
		"show_settings_on_create" => true,
		"js_view" => 'VcColumnView',
		"category"  => 'Content',
		"params" => array(
			array(
				"type"      => "dropdown",
				"holder"    => "div",
				"heading"   => esc_html__("Style", "medicool"),
				"param_name"=> "style",
				"value"     => array(
					esc_html__("Style 1","medicool") => '1',
					esc_html__("Style 2","medicool") => '2',
				),
			),
		)
	) );
	vc_map( array(
		"name"      => esc_html__("Bravo Testimonial Item", "medicool"),
		"base"      => "bravo_testimonial_item",
		"as_child" => array('only' => 'bravo_testimonial'),
		"params"    => array(
			array(
				"type"        => "textfield",
				"heading"     => esc_html__("Name", "medicool"),
				"param_name"  => "name",
				'admin_label' => true
			),
			array(
				"type"        => "textfield",
				"heading"     => esc_html__("Position", "medicool"),
				"param_name"  => "position",
				'admin_label' => true
			),
			array(
				"type"      => "textarea",
				"holder"    => "div",
				"class"     => "",
				"heading"   => esc_html__("Excerpt", "medicool"),
				"param_name"=> "excerpt",
				"value"     => "",
				"description" => esc_html__("Excerpt", "medicool")
			),
			array(
				"type"      => "attach_image",
				"holder"    => "div",
				"class"     => "",
				"heading"   => esc_html__("Avatar", "medicool"),
				"param_name"=> "avatar",
				"value"     => "",
				"description" => esc_html__("Avatar", "medicool"),
			)

		)));

	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_bravo_testimonial extends WPBakeryShortCodesContainer {
			protected function content($arg, $content = null) {
				global $bravo_style;
				$data = shortcode_atts(array(
					'style'=>'1',
				), $arg,'bravo_testimonial');
				extract($data);
				$bravo_style = $style;
				if($style == '1'){
					$html ='<ul class="row client-say">'.do_shortcode($content).'</ul>';
				}else{
					$html = do_shortcode($content);
				}
				unset($bravo_style);

				return $html;
			}
		}
	}

	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_bravo_testimonial_item extends WPBakeryShortCode {
			protected function content($arg, $content = null) {
				global $bravo_style;
				$data = shortcode_atts(array(
					'name' => '',
					'position'  => '',
					'excerpt'  => '',
					'avatar'  => '',
				), $arg,'bravo_testimonial_item');
				extract($data);
				$img = wp_get_attachment_image_src($avatar,'full');
				if(!empty($img)) $img = $img[0];
				if($bravo_style == "1"){
					$html ='<li class="col-sm-4">
							<div class="testimonial">
								<div class="testimonial-ctn">
									<blockquote>
										“'.do_shortcode($excerpt).'”
									</blockquote>
								</div>
								<div class="testimonial-meta">
									<div class="testimonial-cover"><img src="'.esc_url($img).'" alt="'.esc_html($name).'"></div>
									<div class="testimonial-author">
										<strong>'.esc_html($name).'</strong>
										<div class="testimonial-author-info">'.do_shortcode($position).'</div>
									</div>
								</div>
							</div>
						</li>';
				}else{
					$html ='<div class="testimonial-ctn">
                                    <p>'.do_shortcode($excerpt).'</p>
                                    <div class="meta">
                                        <div class="cover">
                                            <span class="corner-icon">
                                                <img src="'.esc_url($img).'" alt="'.esc_html($name).'">
                                            </span>
                                        </div>
                                        <div class="author">
                                            <strong>'.do_shortcode($name).'</strong><br>
                                            <p>'.do_shortcode($position).'</p>
                                        </div>
                                    </div>
                             </div>';
				}
				return $html;
			}
		}
	}
}












