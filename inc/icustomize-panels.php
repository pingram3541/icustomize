<?php
/**
 * Customizer Panels
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
    * Adds iCustomize Options Panel
    **************************************************/

    Kirki::add_panel( 'icustomize_options', array(
        'priority'    => 10,
        'title'       => __( 'iCustomize Options', 'icustomize' ),
        'description' => __( 'Custom CSS and JS', 'icustomize' ),
    ) );