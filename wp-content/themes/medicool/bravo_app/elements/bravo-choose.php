<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 12/18/15
 * Time: 9:16 PM
 */

if (!function_exists('bravo_choose_func')) {
	function bravo_choose_func($attr, $content = false)
	{
		$data = shortcode_atts(array(
			'style' => '1',
			'title' => '',
			'icon_image'  => '',
		), $attr,'bravo_choose');
		extract($data);

		$img = wp_get_attachment_image_src($icon_image,'full');
		if(!empty($img)) $img = $img[0];

		if($style == '1'){
			return '
					<div class="choose">
						<div class="choose-icon">
							<img src="'.esc_url($img).'" alt="'.esc_html($title).'" />
						</div>
						<div class="choose-content">
							<h5 class="tt05">'.esc_html($title).'</h5>
							<div class="color-70">'.do_shortcode($content).'</div>
						</div>
					</div>';
		}else{
			return '
					<div class="highlight-info">
						<div class="shape">
							<div class="decagon">
								<div class="rct"></div>
							</div>
							<span class="icons"><img src="'.esc_url($img).'" alt="decagon"></span>
						</div>
						<h4 class="tt05">'.esc_html($title).'</h4>
						<p class="color-70">'.do_shortcode($content).'</p>
					</div>';
		}


	}

	bravo_reg_shortcode('bravo_choose', 'bravo_choose_func');

	vc_map(array(
		"name"     => esc_html__("Bravo About", "medicool"),
		"base"     => "bravo_choose",
		"category" => "CMSBlueTheme",
		"params"   => array(
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

			array(
				"type"        => "textfield",
				"heading"     => esc_html__("Title", "medicool"),
				"param_name"  => "title",
				'admin_label' => true
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
				"type"      => "attach_image",
				"holder"    => "div",
				"class"     => "",
				"heading"   => esc_html__("Icon Image", "medicool"),
				"param_name"=> "icon_image",
				"value"     => "",
				"description" => esc_html__("Icon Image", "medicool"),
			)

		)
	));
}