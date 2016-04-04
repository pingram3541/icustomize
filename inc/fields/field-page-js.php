<?php
/**
 * Customizer Field - Post/Page JS
 *
 * @package     iCustomize
 * @category    Core
 * @author      wplovr
 * @copyright   Copyright (c) 2016, Philip Ingram, wplovr, wplovr.com
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       0.1
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

    /**
    * Custom Page JS
    ***************************************************/

    Kirki::add_field( 'post_meta', array(
        'type'        => 'code',
        'settings'     => 'icustomize-page-js-' . CURRENT_THEME_NAME,
        'label'       => __( 'Custom Page JS', 'icustomize' ),
        'description' => __( 'Edit the page\'s custom js', 'icustomize' ),
        'help'        => __( 'Make changes here to apply page-only javascript changes to your website.', 'icustomize' ),
        'section'     => 'icustomize_page_js',
        'default'     => __( 'loading...', 'icustomize' ),
        'priority'    => 10,
        'transport'   => 'postMessage',
        'choices'     => array(
            'language' => 'javascript',
            'theme'    => 'monokai',
        ),
        'sanitize_callback' => 'icustomize_page_js',
    ) );

    //update page meta from customize-controls.js
    function icustomize_page_js($value){
        if($value['postid']){
            update_post_meta($value['postid'], 'icustomize-page-js-' . CURRENT_THEME_NAME, $value['data']);
        }
    }