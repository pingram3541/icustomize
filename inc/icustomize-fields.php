<?php
/**
 * Customizer Fields
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
     * Add Custom CSS & JS fields
     */
    include_once( dirname( __FILE__ ) . '/fields/field-master-css.php' );
    include_once( dirname( __FILE__ ) . '/fields/field-master-js.php' );
    include_once( dirname( __FILE__ ) . '/fields/field-page-css.php' ); //only if_singular - see section
    include_once( dirname( __FILE__ ) . '/fields/field-page-js.php' ); //only if_singlular - see section
    
    
    /**
     * Check if WooCommerce is active
     **/
    if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
        
        include_once( dirname( __FILE__ ) . '/fields/field-woocommerce-css.php' );
        include_once( dirname( __FILE__ ) . '/fields/field-woocommerce-js.php' );
        
    }