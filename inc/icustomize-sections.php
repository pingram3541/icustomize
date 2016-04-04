<?php
/**
 * Customizer Sections
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
    * maps to Appearance > iCustomize Options > CSS & JS
    ***************************************************/

    Kirki::add_section( 'icustomize_master_css', array(
        'title'          => __( 'Master CSS' ),
        'description'    => __( 'Add theme-wide custom CSS here', 'icustomize' ),
        'panel'          => 'icustomize_options',
        'priority'       => 160,
        'capability'     => 'edit_theme_options',
    ) );

    Kirki::add_section( 'icustomize_master_js', array(
        'title'          => __( 'Master JS' ),
        'description'    => __( 'Add theme-wide custom JS here', 'icustomize' ),
        'panel'          => 'icustomize_options',
        'priority'       => 160,
        'capability'     => 'edit_theme_options',
    ) );


    /**
    * maps to Post/Page > iCustomize Options > Custom CSS
    ***************************************************/

    Kirki::add_section( 'icustomize_page_css', array(
        'title'          => __( 'Page CSS' ),
        'description'    => __( 'Add page-only custom CSS here', 'icustomize' ),
        'panel'          => 'icustomize_options',
        'priority'       => 160,
        'capability'     => 'edit_theme_options',
    ) );

    /**
    * maps to Post/Page > iCustomize Options > Custom JS
    ***************************************************/

    Kirki::add_section( 'icustomize_page_js', array(
        'title'          => __( 'Page JS' ),
        'description'    => __( 'Add page-only custom JS here', 'icustomize' ),
        'panel'          => 'icustomize_options',
        'priority'       => 160,
        'capability'     => 'edit_theme_options',
    ) );