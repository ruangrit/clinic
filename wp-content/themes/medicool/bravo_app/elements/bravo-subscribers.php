<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 12/18/15
 * Time: 9:16 PM
 */

if (!function_exists('bravo_subscribers_func')) {
	function bravo_subscribers_func($attr, $content = false)
	{
		$data = shortcode_atts(array(
			'title' => '1',
			'sub_title' => '1',
			'bk_image'  => '',
		), $attr,'bravo_subscribers');
		extract($data);
		$bk_img = wp_get_attachment_image_src($bk_image,'full');
		if(!empty($bk_img)) $bk_img = $bk_img[0];
		return '
		 <section class="section-newsletter">
			<div class="subscribers">
				<img style="margin-left: auto; margin-right: auto" src="'.esc_url($bk_img).'" alt="News letter" class="img-responsive hidden-xs">
				<div class="row">
					<div class="col-md-12">
						<div class="subscribe-ctn text-center">
							<h3 class="tt02">'.esc_html($title).'</h3>
							<p class="txt">'.do_shortcode($sub_title).'</p>
							'.do_shortcode($content).'
						</div>
					</div>
				</div>
			</div>
		</section>
		';

	}
	bravo_reg_shortcode('bravo_subscribers', 'bravo_subscribers_func');
	vc_map(array(
		"name"     => esc_html__("Bravo Subscribers", "medicool"),
		"base"     => "bravo_subscribers",
		"category" => "CMSBlueTheme",
		"params"   => array(


			array(
				"type"        => "textfield",
				"heading"     => esc_html__("Title", "medicool"),
				"param_name"  => "title",
				'admin_label' => true
			),
			array(
				"type"        => "textfield",
				"heading"     => esc_html__("Sub Title", "medicool"),
				"param_name"  => "sub_title",
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
				"heading"   => esc_html__("Background Image", "medicool"),
				"param_name"=> "bk_image",
				"value"     => "",
				"description" => esc_html__("Background Image", "medicool"),
			)

		)
	));
}