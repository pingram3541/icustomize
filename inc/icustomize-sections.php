<?php
/**
 * Customizer Sections
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
    * Panel > iCustomize Options > Sections > Master CSS & Master JS
    ***************************************************/

    Kirki::add_section( 'icustomize_master_css', array(
        'title'          => __( 'Master CSS' ),
        'description'    => __( 'Add theme-wide custom CSS here', 'icustomize' ),
        'panel'          => 'icustomize_panel',
        'priority'       => 160,
        'capability'     => 'edit_theme_options',
    ) );

    Kirki::add_section( 'icustomize_master_js', array(
        'title'          => __( 'Master JS' ),
        'description'    => __( 'Add theme-wide custom JS here', 'icustomize' ),
        'panel'          => 'icustomize_panel',
        'priority'       => 160,
        'capability'     => 'edit_theme_options',
    ) );
    
    
    /**
    * Panel > iCustomize Options > Sections > Shop *
    ***************************************************/

    if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
        Kirki::add_section( 'icustomize_shop_master_css', array(
            'title'             => __( 'Shop CSS' ),
            'description'       => __( 'Add shop-wide custom CSS here', 'icustomize' ),
            'panel'             => 'icustomize_panel',
            'priority'          => 160,
            'capability'        => 'edit_theme_options',
            'active_callback'   => 'if_is_woocommerce',
        ) );
    
        Kirki::add_section( 'icustomize_shop_master_js', array(
            'title'             => __( 'Shop JS' ),
            'description'       => __( 'Add shop-wide custom JS here', 'icustomize' ),
            'panel'             => 'icustomize_panel',
            'priority'          => 160,
            'capability'        => 'edit_theme_options',
            'active_callback'   => 'if_is_woocommerce',
        ) );
        
        //if previewing a woocommerce page
        function if_is_woocommerce(){
            if( is_woocommerce() || is_cart() || is_checkout() ){
                return true;
            } else {
                return false;    
            }
        }
    }


    /**
    * Panel > iCustomize Options > Section > Custom CSS
    ***************************************************/

    Kirki::add_section( 'icustomize_page_css', array(
        'title'             => __( 'Page CSS' ),
        'description'       => __( 'Add page-only custom CSS here', 'icustomize' ),
        'panel'             => 'icustomize_panel',
        'priority'          => 160,
        'capability'        => 'edit_theme_options',
        'active_callback'   => 'if_is_singular',
    ) );

    /**
    * Panel > iCustomize Options > Section > Custom JS
    ***************************************************/

    Kirki::add_section( 'icustomize_page_js', array(
        'title'             => __( 'Page JS' ),
        'description'       => __( 'Add page-only custom JS here', 'icustomize' ),
        'panel'             => 'icustomize_panel',
        'priority'          => 160,
        'capability'        => 'edit_theme_options',
        'active_callback'   => 'if_is_singular',
    ) );
    
    function if_is_singular(){
        if( is_singular() ){
            return true;
        } else {
            return false;
        }    
    }