<?php

if (!function_exists('bravo_list_post_func')) {
	function bravo_list_post_func($attr, $content = false)
	{
		$attr = wp_parse_args($attr, array(
			'number' => '6',
			'number_of_row'  => '3',
			'order'  => 'asc',
			'orderby'  => 'none',
		));
		return BravoTemplate::load_view('elements/bravo-list-post', false, $attr);
	}

	bravo_reg_shortcode('bravo_list_post', 'bravo_list_post_func');

	vc_map(array(
		"name"     => esc_html__("Bravo List Post", "medicool"),
		"base"     => "bravo_list_post",
		"category" => "CMSBlueTheme",
		"params"   => array(

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