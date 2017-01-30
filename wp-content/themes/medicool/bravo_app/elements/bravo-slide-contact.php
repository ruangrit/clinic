<?php
if(!function_exists('bravo_slide_contact')) {
	vc_map( array(
		"name" => esc_html__("Bravo Slide Contact", "medicool"),
		"base" => "bravo_slide_contact",
		"as_parent" => array('only' => 'bravo_slide_contact_item'),
		"content_element" => true,
		"show_settings_on_create" => true,
		"js_view" => 'VcColumnView',
		"category"  => 'Content',
		"params" => array(
			array(
				"type"      => "textarea",
				"holder"    => "div",
				"class"     => "",
				"heading"   => esc_html__("Content", "medicool"),
				"param_name"=> "bravo_content",
				"description" => esc_html__("Content", "medicool"),
			)
		)
	) );
	vc_map( array(
		"name"      => esc_html__("Bravo Slide Carousel Item", "medicool"),
		"base"      => "bravo_slide_contact_item",
		"as_child" => array('only' => 'bravo_slide_contact'),
		"params"    => array(

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
		class WPBakeryShortCode_bravo_slide_contact extends WPBakeryShortCodesContainer {
			protected function content($arg, $content = null) {
				global $bravo_stt;
				$bravo_stt =0;
				$data = shortcode_atts(array(
					'bravo_content'=>'',
				), $arg,'bravo_slide_contact');
				extract($data);
				$html ='

				<!-- Write code -->
                <section id="slider-section" class="slider-section container-fluid no-padding">
                    <div id="home-slider" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            '.do_shortcode($content).'
                            <a href="#home-slider" class="left carousel-control" role="button" data-slide="prev"><i class="fa fa-angle-left"></i> </a>
                            <a href="#home-slider" class="right carousel-control" role="button" data-slide="next"><i class="fa fa-angle-right"></i> </a>
                        </div>
                    </div>
                    <div class="make-appointmen">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-10 col-sm-6 col-md-4 pull-right">
                                    '.do_shortcode($bravo_content).'
                                </div>
                            </div>

                        </div>
                    </div>
                </section>
                <!-- E: .section-section -->

				';
				return $html;
			}
		}
	}

	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_bravo_slide_contact_item extends WPBakeryShortCode {
			protected function content($arg, $content = null) {
				global $bravo_stt;
				$data = shortcode_atts(array(
					'background'=>'',
				), $arg,'bravo_slide_contact_item');
				extract($data);
				$class="";
				if($bravo_stt == 0){
					$class = 'active';
				}
				$img = wp_get_attachment_image_src($background,'full');
				if(!empty($img)) $img = $img[0];
				$html ='
				 <div class="item '.esc_attr($class).'">
                                <img src="'.esc_url($img).'" width="1920" height="800" alt="slide1">
                 </div>';
				$bravo_stt ++;
				return $html;
			}
		}
	}
}


