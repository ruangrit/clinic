<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 12/18/15
 * Time: 9:16 PM
 */

if (!function_exists('bravo_choose_func')) {
	function bravo_call_to_action_func($attr, $content = false)
	{
		$data = shortcode_atts(array(
			'title' => '',
			'link'  => '',
		), $attr,'bravo_call_to_action');
		extract($data);
		$link  = vc_build_link( $link );

		return '
				<div class="row">
					<div class="col-md-8">
						<p class="text-title">'.esc_html($title).'</p>
						<span>'.do_shortcode($content).'</span>
					</div>
					<div class="col-md-2">
						<a href="'.esc_url($link['url']).'" class="button-border">'.esc_html($link['title']).'</a>
					</div>
				</div>';
	}
	bravo_reg_shortcode('bravo_call_to_action', 'bravo_call_to_action_func');
	vc_map(array(
		"name"     => esc_html__("Bravo Call To Action", "medicool"),
		"base"     => "bravo_call_to_action",
		"category" => "CMSBlueTheme",
		"params"   => array(
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
				"type"      => "vc_link",
				"holder"    => "div",
				"heading"   => esc_html__("Link", "medicool"),
				"param_name"=> "link",
			),
		)
	));
}