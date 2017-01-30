<?php
/*
Plugin Name: cmsBlue Toolkit
Plugin URI: #
Description:Plugin only for Themes of cmsBlueTheme. Contain all helper functions
Version: 1.1.3
Author: cmsBlueTheme
Author URI: http://www.cmsBlueTheme.com
License: GPLv2 or later
Text Domain: cmsblue-toolkit
*/
if(!defined('CMSBLUETOOLKIT')){
    define('CMSBLUETOOLKIT','cmsblue-toolkit');
}
if(!class_exists('cmsBlueTookit'))
{

    class cmsBlueTookit
    {
        static function dir($file=false)
        {
            return plugin_dir_path(__FILE__).$file;
        }
        static function init()
        {
            // Core Functions
            require_once self::dir('cmsblue-core-functions.php');

            self::_load_class();

            //Load Required Plugins
            // cmb2:2.0.0.9
            //require_once self::dir('plugins/cmb2/init.php');
            require_once self::dir('plugins/menu.exporter.php');
            require_once self::dir('plugins/importer/importer.php');
            require_once self::dir('plugins/class-wp-twitter-api.php');
            add_action( 'plugins_loaded', array(__CLASS__,'_load_text_domain') );
        }

        static function _load_text_domain()
        {
            load_plugin_textdomain( CMSBLUETOOLKIT, false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
        }

        private static function _load_class()
        {
            $dirs = array_filter(glob(self::dir().'class/*'), 'is_file');

            if(!empty($dirs))
            {
                foreach($dirs as $key=>$value)
                {
                    require_once $value;

                }
            }
        }
    }
    cmsBlueTookit::init();

}