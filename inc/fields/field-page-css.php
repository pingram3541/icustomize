<?php
/**
 * Customizer Field - Post/Page CSS
 *
 * @package     iCustomize
 * @category    Core
 * @author      wplovr
 * @copyright   Copyright (c) 2016, Philip Ingram, wplovr, wplovr.com
 * @license     http://www.gnu.org/licenses/gpl-3.0.en.html
 * @since       0.01
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

    /**
    * Custom Page CSS
    ***************************************************/

    Kirki::add_field( 'post_meta_config', array(
        'type'        => 'code',
        'settings'     => 'icustomize-page-css-' . CURRENT_THEME_NAME,
        'label'       => __( 'Custom Page CSS', 'icustomize' ),
        'description' => __( 'Edit the page\'s custom css', 'icustomize' ),
        'help'        => __( 'Make changes here to apply page-only style changes to your website.', 'icustomize' ),
        'section'     => 'icustomize_page_css',
        'default'     => __( 'loading...', 'icustomize' ),
        'priority'    => 10,
        'transport'   => 'postMessage',
        'choices'     => array(
            'language' => 'css',
            'theme'    => 'monokai',
        ),
        'sanitize_callback' => 'icustomize_page_css',
    ) );
    
    //update page meta from customize-controls.js
    if ( ! function_exists('icustomize_page_css')) {
        
        function icustomize_page_css($value){
            if ( (array) $value === $value ) { 
                if($value['postid']){
                    update_post_meta($value['postid'], 'icustomize-page-css-' . CURRENT_THEME_NAME, $value['data']);
                } 
            }
        }
    }