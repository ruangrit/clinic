<?php
if(!function_exists('bravo_slide_carousel')) {
	vc_map( array(
		"name" => esc_html__("Bravo Slide Carousel", "medicool"),
		"base" => "bravo_slide_carousel",
		"as_parent" => array('only' => 'bravo_slide_carousel_item'),
		"content_element" => true,
		"show_settings_on_create" => true,
		"js_view" => 'VcColumnView',
		"category"  => 'Content',
		"params" => array(
		)
	) );
	vc_map( array(
		"name"      => esc_html__("Bravo Slide Carousel Item", "medicool"),
		"base"      => "bravo_slide_carousel_item",
		"as_child" => array('only' => 'bravo_slide_carousel'),
		"params"    => array(
			array(
				"type"      => "textfield",
				"holder"    => "div",
				"class"     => "",
				"heading"   => esc_html__("Title", "medicool"),
				"param_name"=> "title",
				"value"     => "",
				"description" => esc_html__("Title", "medicool")
			),
			array(
				"type"      => "textarea",
				"holder"    => "div",
				"class"     => "",
				"heading"   => esc_html__("Content", "medicool"),
				"param_name"=> "content",
				"value"     => "",
				"description" => esc_html__("content", "medicool")
			),

			array(
				"type"      => "vc_link",
				"holder"    => "div",
				"class"     => "",
				"heading"   => esc_html__("Link More", "medicool"),
				"param_name"=> "link",
				"value"     => "",
				"description" => esc_html__("Link More", "medicool")
			),

			array(
				"type"      => "attach_image",
				"holder"    => "div",
				"class"     => "",
				"heading"   => esc_html__("Background Image", "medicool"),
				"param_name"=> "background",
				"value"     => "",
				"description" => esc_html__("Background Image", "medicool"),
				'edit_field_class' => 'vc_col-sm-4' ,
			)

		)));

	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_bravo_slide_carousel extends WPBakeryShortCodesContainer {
			protected function content($arg, $content = null) {
				global $bravo_stt;
				$bravo_stt =0;
				$data = shortcode_atts(array(
					'title'=>'',
				), $arg,'bravo_slide_carousel');
				extract($data);
				$html ='
				<section id="slider-section" class="slider-section container-fluid no-padding">
                    <div id="home-slider" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">

                            '.do_shortcode($content).'
                            <a href="#home-slider" class="left carousel-control" role="button" data-slide="prev"><i class="fa fa-angle-left"></i> </a>
                            <a href="#home-slider" class="right carousel-control" role="button" data-slide="next"><i class="fa fa-angle-right"></i> </a>
                        </div>
                    </div>
                </section>
				';
				return $html;
			}
		}
	}

	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_bravo_slide_carousel_item extends WPBakeryShortCode {
			protected function content($arg, $content = null) {
				global $bravo_stt;
				$data = shortcode_atts(array(
					'title'=>'',
					'link'=>'',
					'background'=>'',
				), $arg,'bravo_slide_carousel_item');
				extract($data);
				$img = wp_get_attachment_image_src($background,'full');
				if(!empty($img)) $img = $img[0];
				$tp_link = vc_build_link( $link );
				$class="";
				if($bravo_stt == 0){
					$class = 'active';
				}
				$html ='
				<div class="item '.esc_attr($class).'">
					<img src="'.esc_url($img).'" width="1840" height="800" alt="slide1">
					<div class="carousel-caption">
						<div class="container">
							<div class="col-md-7 col-sm-8 col-xs-12 ow-pull-right">
								<h3 data-animation="animated bounceInLeft">
								   '.esc_html($title).'
								</h3>
								<p data-animation="animated bounceInLeft">
								'.do_shortcode($content).'</p>
								<a href="'.esc_url($tp_link['url']).'" title="viewmore" data-animation="animated fadeInUp">'.esc_html($tp_link['title']).'</a>
							</div>
						</div>
					</div>
				</div>
				';
				$bravo_stt ++;
				return $html;
			}
		}
	}
}


