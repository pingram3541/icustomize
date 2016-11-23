<?php
/**
 * Customizer Field - WooCommerce Master CSS
 *
 * @package     iCustomize
 * @category    Core
 * @author      wplovr
 * @copyright   Copyright (c) 2016, Philip Ingram, wplovr, wplovr.com
 * @license     http://www.gnu.org/licenses/gpl-3.0.en.html
 * @since       0.04
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$theme = CURRENT_THEME_NAME;

    /**
    * WooCommerce Master CSS
    ***************************************************/

    Kirki::add_field( 'icustomize_config', array(
        'type'        => 'code',
        'settings'     => 'icustomize-wc-master-css-' . $theme,
        'label'       => __( 'Shop CSS', 'icustomize' ),
        'description' => __( 'Edit shop-wide custom css', 'icustomize' ),
        'help'        => __( 'Make changes here to apply shop-wide style changes to your website.', 'icustomize' ),
        'section'     => 'icustomize_shop_master_css',
        'default'     => __( '', 'icustomize' ),
        'priority'    => 10,
        'transport'   => 'postMessage',
        'choices'     => array(
            'language' => 'css',
            'theme'    => 'monokai',
        ),
    ) );