<?php

if (!function_exists('bravo_list_departments_func')) {
	function bravo_list_departments_func($attr, $content = false)
	{
		$attr = wp_parse_args($attr, array(
			'number' => '6',
			'style'  => '1',
			'bravo_departments_cat'  => '',
			'number_of_row'  => 'yes',
			'order'  => 'asc',
			'orderby'  => 'none',
		));
		return BravoTemplate::load_view('elements/departments/bravo-list-departments', false, $attr);
	}

	bravo_reg_shortcode('bravo_list_departments', 'bravo_list_departments_func');

	vc_map(array(
		"name"     => esc_html__("Bravo List Departments", "medicool"),
		"base"     => "bravo_list_departments",
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
					esc_html__("Style 3","medicool") => '3',
					esc_html__("Style 4","medicool") => '4',
				),
			),
			array(
				"type" => "checkbox",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__("Category", "medicool"),
				"param_name" => "bravo_departments_cat",
				"value" => bravo_get_list_taxonomy('bravo_departments_cat'),
				"description" => esc_html__("<em>Tick 'All Categories' if you want to show portfolios of all Categories</em>", "medicool")
			),
			array(
				"type"        => "textfield",
				"heading"     => esc_html__("Number", "medicool"),
				"param_name"  => "number",
				'admin_label' => true,
			),
			array(
				"type"        => "textfield",
				"heading"     => esc_html__("Number of Row", "medicool"),
				"param_name"  => "number_of_row",
				'admin_label' => true,
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