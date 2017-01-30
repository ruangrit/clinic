<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 3/3/15
 * Time: 1:15 PM
 */
/**
 * Register post type
 *
 *
 * */

if(!function_exists('bravo_reg_post_type'))
{
    function bravo_reg_post_type($post_type, $args)
    {
        register_post_type($post_type, $args);
    }
}
/**
 * Register post type
 *
 *
 * */

if(!function_exists('bravo_reg_taxonomy'))
{
    function bravo_reg_taxonomy($taxonomy, $object_type, $args )
    {
        register_taxonomy($taxonomy, $object_type, $args );
    }
}
/**
 * Add shortcode
 *
 *
 * */

if(!function_exists('bravo_reg_shortcode'))
{
    function bravo_reg_shortcode($tag , $func )
    {
        add_shortcode($tag , $func );
    }
}