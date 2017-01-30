<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 12/18/15
 * Time: 9:16 PM
 */
if (!function_exists('bravo_banner_page_func')) {
	function bravo_banner_page_func($attr, $content = false)
	{
		$data = shortcode_atts(array(
			'title' => '',
			'bg_image'  => '',
		), $attr,'bravo_banner_page');
		extract($data);
		$bg_image = wp_get_attachment_image_src($bg_image,'full');
		if(!empty($bg_image)) $bg_image = $bg_image[0];
		$class = BravoAssets::build_css(' background: url("'.esc_url($bg_image).'") no-repeat fixed center center / cover ;');

		ob_start();
		get_template_part('bc');
		$bc = ob_get_contents();
		ob_end_clean();


		return ' <section class="section-subbanner '.esc_attr($class).'">
					<div class="container">
						<div class="row">
							<div class="col-sm-12 col-md-12">
								<div class="caption">'.esc_html($title).'</div>
								'.do_shortcode($bc).'
							</div>
						</div>
					</div>
				</section>';
	}
	bravo_reg_shortcode('bravo_banner_page', 'bravo_banner_page_func');
	vc_map(array(
		"name"     => esc_html__("Bravo Banner Page", "medicool"),
		"base"     => "bravo_banner_page",
		"category" => "CMSBlueTheme",
		"params"   => array(
			array(
				"type"        => "textfield",
				"heading"     => esc_html__("Title", "medicool"),
				"param_name"  => "title",
				'admin_label' => true
			),
			array(
				"type"      => "attach_image",
				"holder"    => "div",
				"class"     => "",
				"heading"   => esc_html__("Background Image", "medicool"),
				"param_name"=> "bg_image",
				"value"     => "",
				"description" => esc_html__("Background Image", "medicool"),
			)
		)
	));
}