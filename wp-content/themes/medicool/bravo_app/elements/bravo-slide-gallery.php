<?php

if (!function_exists('bravo_slide_gallery_func')) {
	function bravo_slide_gallery_func($attr, $content = false)
	{
		$attr = wp_parse_args($attr, array(
			'number' => '10',
			'style'  => '1',
			'show_control'  => 'yes',
			'bravo_gallery'  => '',
			'link_view_all'  => '',
			'order'  => 'asc',
			'orderby'  => 'none',
		));
		return BravoTemplate::load_view('elements/gallery/bravo-slide-gallery', false, $attr);
	}

	bravo_reg_shortcode('bravo_slide_gallery', 'bravo_slide_gallery_func');

	vc_map(array(
		"name"     => esc_html__("Bravo Slide Gallery", "medicool"),
		"base"     => "bravo_slide_gallery",
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
				"type" => "checkbox",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__("Category", "medicool"),
				"param_name" => "bravo_gallery",
				"value" => bravo_get_list_taxonomy('bravo_gallery_cat'),
				"description" => esc_html__("<em>Tick 'All Categories' if you want to show portfolios of all Categories</em>", "medicool")
			),
			array(
				"type"        => "textfield",
				"heading"     => esc_html__("Number", "medicool"),
				"param_name"  => "number",
				'admin_label' => true
			),
			array(
				"type"      => "dropdown",
				"holder"    => "div",
				"heading"   => esc_html__("Show Control", "medicool"),
				"param_name"=> "show_control",
				"value"     => array(
					esc_html__("Yes","medicool") => 'yes',
					esc_html__("No","medicool") => 'no',
				),
			),
			array(
				"type"      => "vc_link",
				"holder"    => "div",
				"heading"   => esc_html__("Link View All", "medicool"),
				"param_name"=> "link_view_all",
			),
			array(
				"type"             => "dropdown" ,
				"holder"           => "div" ,
				"heading"          => esc_html__( "Order" , "medicool" ) ,
				"param_name"       => "order" ,
				'value'            => array(
					esc_html__( 'Asc' , "medicool" )  => 'asc' ,
					esc_html__( 'Desc' , "medicool" ) => 'desc'
				) ,
				'edit_field_class' => 'vc_col-sm-6' ,
			) ,
			array(
				"type"             => "dropdown" ,
				"holder"           => "div" ,
				"heading"          => esc_html__( "Order By" , "medicool" ) ,
				"param_name"       => "orderby" ,
				"value"            => array(
					esc_html__( 'None' , "medicool" )          => 'none' ,
					esc_html__( 'ID' , "medicool" )            => 'ID' ,
					esc_html__( 'Author' , "medicool" )        => 'author' ,
					esc_html__( 'Title' , "medicool" )         => 'title' ,
					esc_html__( 'Name' , "medicool" )          => 'name' ,
					esc_html__( 'Type' , "medicool" )          => 'type' ,
					esc_html__( 'Date' , "medicool" )          => 'date' ,
					esc_html__( 'Modified' , "medicool" )      => 'modified' ,
					esc_html__( 'Parent' , "medicool" )        => 'parent' ,
					esc_html__( 'Rand' , "medicool" )          => 'rand' ,
					esc_html__( 'Comment Count' , "medicool" ) => 'comment_count' ,
				) ,
				'edit_field_class' => 'vc_col-sm-6' ,
			) ,

		)
	));
}