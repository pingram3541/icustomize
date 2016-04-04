<?php
/**
 * Customizer Field Configs
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
    * Config for icustomize $prefix_options serialized array (wp_options > icustomize)
    **************************************************/
    Kirki::add_config( 'icustomize', array(
        'capability'    => 'edit_theme_options',
        'option_type'   => 'option',
        'option_name'   => 'icustomize',
    ) );


    /**
    * Config for post_meta types
    **************************************************/
    Kirki::add_config( 'post_meta', array(
        'capability'    => 'edit_theme_options',
        'option_type'   => 'post_meta',
        //don't use 'option_name' otherwise value is stored in wp_options under that key anyway
    ) );

    /**
    * Handle saving of post_meta settings with "post_meta" storage type.
    *
    * @param string $value
    * @param $setting->id
    */
    //add_action( 'customize_update_post_meta', 'icustomize_update_post_meta');
    function icustomize_update_post_meta( $value ) {
        //future, currently using field callback to update
    }

    /**
    * Handle previewing of post_meta settings with "post_meta" storage type.
    *
    * @param string $value
    * @param $setting->id
    */
    //add_action( 'customize_preview_post_meta', 'icustomize_preview_post_meta');
    function icustomize_preview_post_meta( $setting ) {
        //future, currently using field postMessage for preview
    }