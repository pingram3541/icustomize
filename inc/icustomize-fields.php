<?php
/**
 * Customizer Fields
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
     * Add Custom CSS & JS fields
     */
    include_once( dirname( __FILE__ ) . '/fields/field-master-css.php' );
    include_once( dirname( __FILE__ ) . '/fields/field-master-js.php' );
    include_once( dirname( __FILE__ ) . '/fields/field-page-css.php' );
    include_once( dirname( __FILE__ ) . '/fields/field-page-js.php' );