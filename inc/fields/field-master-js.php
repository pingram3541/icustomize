<?php
/**
 * Customizer Field - Master JS
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
    * Custom JS
    ***************************************************/

    Kirki::add_field( 'icustomize', array(
        'type'        => 'code',
        'settings'     => 'icustomize-master-js-' . $theme,
        'label'       => __( 'Master JS', 'icustomize' ),
        'description' => __( 'Edit site-wide custom js', 'icustomize' ),
        'help'        => __( 'Make changes here to apply site wide javascript changes to your website.', 'icustomize' ),
        'section'     => 'icustomize_master_js',
        'default'     => __( '', 'icustomize' ),
        'priority'    => 10,
        'transport'   => 'postMessage',
        'choices'     => array(
            'language' => 'javascript',
            'theme'    => 'monokai',
        ),
    ) );