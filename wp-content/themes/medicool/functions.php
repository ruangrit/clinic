<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 2/25/15
 * Time: 8:17 PM
 */


load_theme_textdomain("medicool",get_template_directory().'/language');

include( get_template_directory() . '/bravo_ecommerce/index.php');
if(file_exists(get_template_directory().'/demo/demofunction.php')){
    include( get_template_directory() . '/demo/demofunction.php');
}

