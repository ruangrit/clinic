<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 12/18/15
 * Time: 9:16 PM
 */

if (!function_exists('bravo_button_func')) {
	function bravo_button_func($attr, $content = false)
	{
		$attr = wp_parse_args($attr, array(
			'text' => '',
			'url' => '',
			'extra_class'=>''
		));

		$attr['content'] = do_shortcode($content);

		return BravoTemplate::load_view('elements/button', false, $attr);
	}

	bravo_reg_shortcode('bravo_button', 'bravo_button_func');

	vc_map(array(
		"name"     => esc_html__("Bravo Button", "medicool"),
		"base"     => "bravo_button",
		"category" => "CMSBlueTheme",
		"params"   => array(

			array(
				"type"        => "textfield",
				"heading"     => esc_html__("Text", "medicool"),
				"param_name"  => "text",
				'admin_label' => true
			),
			array(
				"type"        => "textfield",
				"heading"     => esc_html__("URL", "medicool"),
				"param_name"  => "url",
				'admin_label' => true
			),
			array(
				"type"        => "textfield",
				"heading"     => esc_html__("Extra Class", "medicool"),
				"param_name"  => "extra_class",
				'admin_label' => true
			),


		)
	));
}