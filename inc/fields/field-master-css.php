<?php
/**
 * Customizer Field - Master CSS
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

$theme = CURRENT_THEME_NAME;

    /**
    * Master CSS
    ***************************************************/

    Kirki::add_field( 'icustomize', array(
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