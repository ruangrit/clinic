<?php
if(!function_exists('bravo_list_notype')) {
	vc_map( array(
		"name" => esc_html__("Bravo List Notype", "medicool"),
		"base" => "bravo_list_notype",
		"as_parent" => array('only' => 'bravo_list_notype_item'),
		"content_element" => true,
		"show_settings_on_create" => false,
		"js_view" => 'VcColumnView',
		"category"  => 'Content',
		"params" => array(
			array(
				"type"      => "textfield",
				"holder"    => "div",
				"class"     => "",
				"heading"   => esc_html__("Title", "medicool"),
				"param_name"=> "title",
				"value"     => "",
				"description" => esc_html__("Title", "medicool")
			),
		)
	) );
	vc_map( array(
		"name"      => esc_html__("Bravo List Notype Item", "medicool"),
		"base"      => "bravo_list_notype_item",
		"as_child" => array('only' => 'bravo_list_notype'),
		"content_element" => true,
		"params"    => array(
			array(
				"type"      => "vc_link",
				"holder"    => "div",
				"class"     => "",
				"heading"   => esc_html__("Link", "medicool"),
				"param_name"=> "link",
				"value"     => "",
				"description" => esc_html__("Link", "medicool")
			),
		)));

	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_bravo_list_notype extends WPBakeryShortCodesContainer {
			protected function content($arg, $content = null) {
				$data = shortcode_atts(array(
					'title'=>'',
				), $arg,'bravo_list_notype');
				extract($data);
				$html ='<h3>'.esc_html($title).'</h3>
						<ul class="notype lists">
							'.do_shortcode($content).'
						</ul>
				';
				return $html;
			}
		}
	}

	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_bravo_list_notype_item extends WPBakeryShortCode {
			protected function content($arg, $content = null) {
				$data = shortcode_atts(array(
					'link'=>'',
				), $arg,'bravo_list_notype_item');
				extract($data);
				$tp_link = vc_build_link( $link );
				$html ='<li><a href="'.esc_url($tp_link['url']).'"><i class="fa fa-caret-right"></i>'.esc_html($tp_link['title']).'</a> </li>';
				return $html;
			}
		}
	}
}


