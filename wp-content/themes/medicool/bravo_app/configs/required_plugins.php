<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 2/28/15
 * Time: 8:17 PM
 */


/**
 * List all required plugins for themes
 *
 * @see BravoRequiredPlugins::register_required_plugins();
 *
 *
 * */
$config['required_plugins'] = array(
    array(
        'name'     => esc_html__('Option Tree','medicool'), // The plugin name.
        'slug'     => 'option-tree', // The plugin slug (typically the folder name).
        'required' => true, // If false, the plugin is only 'recommended' instead of required.
    ),
    array(
        'name'     => esc_html__('Contact Form 7','medicool'),
        'slug'     => 'contact-form-7',
        'required' => true,
    ),
    array(
        'name'     => esc_html__('Visual Composer','medicool'),
        'slug'     => 'js_composer',
        'required' => true,
        'source'   =>  esc_url('http://premiumbluethemes.com/WordPress/wp_smarty/files/js_composer.zip')
    ),
    array(
        'name'     => esc_html__('cmsBlue Toolkit','medicool'),
        'slug'     => 'cmsblue-toolkit',
        'required' => true,
        'source'   => esc_url('http://premiumbluethemes.com/WordPress/wp_smarty/files/cmsblue-toolkit1.1.3.zip')
    ),
    array(
        'name'     => esc_html__('MailChimp for WordPress','medicool'),
        'slug'     => 'mailchimp-for-wp',
        'required' => false
    ),
    array(
        'name'     => esc_html__('Breadcrumb NavXT','medicool'),
        'slug'     => 'breadcrumb-navxt',
        'required' => false
    )
);