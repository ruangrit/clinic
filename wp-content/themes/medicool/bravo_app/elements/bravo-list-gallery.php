<?php

if (!function_exists('bravo_list_gallery_func')) {
	function bravo_list_gallery_func($attr, $content = false)
	{
		$attr = wp_parse_args($attr, array(
			'number' => '10',
			'number_of_row'  => '3',
			'bravo_gallery'  => '',
			'show_pagination'  => 'off',
			'order'  => 'asc',
			'orderby'  => 'none',
		));
		return BravoTemplate::load_view('elements/gallery/bravo-list-gallery', false, $attr);
	}

	bravo_reg_shortcode('bravo_list_gallery', 'bravo_list_gallery_func');

	vc_map(array(
		"name"     => esc_html__("Bravo List Gallery", "medicool"),
		"base"     => "bravo_list_gallery",
		"category" => "CMSBlueTheme",
		"params"   => array(
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
				"type"        => "textfield",
				"heading"     => esc_html__("Number of Row", "medicool"),
				"param_name"  => "number_of_row",
				'admin_label' => true
			),
			array(
				"type"      => "dropdown",
				"holder"    => "div",
				"heading"   => esc_html__("Show Pagination", "medicool"),
				"param_name"=> "show_pagination",
				"value"     => array(
					esc_html__("Off","medicool") => 'off',
					esc_html__("On","medicool") => 'on',
				),
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