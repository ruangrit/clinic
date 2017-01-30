<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 1/13/16
 * Time: 7:47 PM
 */
if(!function_exists('bravo_head_enormous_func'))
{
	function bravo_head_enormous_func($attr=array(),$content)
	{
		return sprintf("<span class='heading-enormous'>%s</span>",do_shortcode($content));
	}

	bravo_reg_shortcode('head_enormous','bravo_head_enormous_func');
}

if(!function_exists('bravo_head_hug_func'))
{
	function bravo_head_hug_func($attr=array(),$content)
	{
		return sprintf("<span class='heading-huge'>%s</span>",do_shortcode($content));
	}

	bravo_reg_shortcode('head_huge','bravo_head_hug_func');
}



if(!function_exists('bravo_head_big_func'))
{
	function bravo_head_big_func($attr=array(),$content)
	{
		return sprintf("<span class='heading-big'>%s</span>",do_shortcode($content));
	}

	bravo_reg_shortcode('head_big','bravo_head_big_func');
}

if(!function_exists('bravo_text_big_func'))
{
	function bravo_text_big_func($attr=array(),$content)
	{
		return sprintf("<span class='text-big'>%s</span>",do_shortcode($content));
	}

	bravo_reg_shortcode('text_big','bravo_text_big_func');
}
if(!function_exists('bravo_note_func'))
{
	function bravo_note_func($attr=array(),$content)
	{
		return sprintf("<span class='note'>%s</span>",do_shortcode($content));
	}

	bravo_reg_shortcode('bs_note','bravo_note_func');
}

if(!function_exists('bravo_animate_func'))
{
	function bravo_animate_func($attr=array(),$content)
	{
		$attr=wp_parse_args($attr,
			array(
				'delay'=>'',
				'id'=>''
			));
		return sprintf("<span class='bravo-animate onscroll-animate' data-delay='%s' data-animation='%s'>%s</span>",$attr['delay'],$attr['id'],do_shortcode($content));
	}

	bravo_reg_shortcode('bs_animate','bravo_animate_func');
}

if(!function_exists('bravo_strong_func'))
{
	function bravo_strong_func($attr=array(),$content)
	{
		$attr=wp_parse_args($attr,
			array(
				'delay'=>'',
				'id'=>''
			));
		return sprintf("<p class='text-big' ><strong>%s</strong></p>",do_shortcode($content));
	}

	bravo_reg_shortcode('text_strong','bravo_strong_func');
}
