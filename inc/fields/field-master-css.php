<?php
/**
 * Customizer Field - Master CSS
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

$theme = CURRENT_THEME_NAME;

    /**
    * Master CSS
    ***************************************************/

    Kirki::add_field( 'icustomize_config', array(
        'type'        => 'code',
        'settings'     => 'icustomize-master-css-' . $theme,
        'label'       => __( 'Master CSS', 'icustomize' ),
        'description' => __( 'Edit site-wide custom css', 'icustomize' ),
        'help'        => __( 'Make changes here to apply site wide style changes to your website.', 'icustomize' ),
        'section'     => 'icustomize_master_css',
        'default'     => __( '', 'icustomize' ),
        'priority'    => 10,
        'transport'   => 'postMessage',
        'choices'     => array(
            'language' => 'css',
            'theme'    => 'monokai',
        ),
    ) );