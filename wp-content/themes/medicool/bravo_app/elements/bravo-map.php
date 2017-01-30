<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 12/18/15
 * Time: 9:16 PM
 */

if (!function_exists('bravo_map_func')) {
	function bravo_map_func($attr, $content = false)
	{
		$data = shortcode_atts(array(
			'address'=>'93 Worth St, New York, NY',
			'type'=>1,
			'marker'=>'',
			'height'=>'480',
			'lightness'=>0,
			'saturation'=>0,
			'gama'=>0.5,
			'zoom'=>13,
			'longitude'=>false,
			'latitude'=>false
		), $attr,'bravo_map');
		extract($data);

		$marker = wp_get_attachment_image_src($marker,'full');
		if(!empty($marker)) $marker = $marker[0];
		return "<div class='map_wrap'><div data-type='{$type}' data-lat='{$latitude}' data-lng='{$longitude}' data-zoom='{$zoom}' style='height: {$height}px' data-lightness='{$lightness}' data-saturation='{$saturation}' data-gama='{$gama}'  class='st_google_map' data-address='{$address}' data-marker='$marker'>
                            </div></div>";
	return '';

	}

	bravo_reg_shortcode('bravo_map', 'bravo_map_func');

	vc_map(array(
		"name"     => esc_html__("Bravo Map", "medicool"),
		"base"     => "bravo_map",
		"category" => "CMSBlueTheme",
		"params"   => array(
			array(
				"type"      => "dropdown",
				"holder"    => "div",
				"class"     => "",
				"heading"   => esc_html__("Type", "medicool"),
				"param_name"=> "type",
				"value"     => array(
					esc_html__('--Select--',"medicool")=>'',
					esc_html__('Use Address',"medicool")=>1,
					esc_html__('User Latitude and Longitude',"medicool")=>2,
				),
				"description" => esc_html__("Address or using Latitude and Longitude", "medicool")
			),

			array(
				"type"      => "textfield",
				"holder"    => "div",
				"class"     => "",
				"heading"   => esc_html__("Address", "medicool"),
				"param_name"=> "address",
				"value"     => "",
				"description" => esc_html__("Address", "medicool")
			),
			array(
				"type"      => "textfield",
				"holder"    => "div",
				"class"     => "",
				"heading"   => esc_html__("Latitude", "medicool"),
				"param_name"=> "latitude",
				"value"     => "",
				"description" => esc_html__("Latitude, you can get it from  <a target='_blank' href='http://www.latlong.net/convert-address-to-lat-long.html'>here</a>", "medicool")
			),
			array(
				"type"      => "textfield",
				"holder"    => "div",
				"class"     => "",
				"heading"   => esc_html__("Longitude", "medicool"),
				"param_name"=> "longitude",
				"value"     => "",
				"description" => esc_html__("Longitude", "medicool")
			),
			array(
				"type"      => "textfield",
				"holder"    => "div",
				"class"     => "",
				"heading"   => esc_html__("Zoom", "medicool"),
				"param_name"=> "zoom",
				"value"     => 13,
			),
			array(
				"type"      => "attach_image",
				"holder"    => "div",
				"class"     => "",
				"heading"   => esc_html__("Custom Marker Icon", "medicool"),
				"param_name"=> "marker",
				"value"     => "",
				"description" => esc_html__("Custom Marker Icon", "medicool")
			),

		)
	));
}