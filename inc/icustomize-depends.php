<?php
/**
 * Customizer Dependencies
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
    * Enqueue Customizer custom css and js files
    **************************************************/
    if(! function_exists('icustomize_control_enqueue')){
        function icustomize_control_enqueue(){
            global $wp_customize;

            $opt = 'min.';

            if ( isset( $wp_customize ) ) {
                if ( IC_DEBUG == true ) $opt = '';
                wp_enqueue_style( 'icustomize-control-style', plugins_url( '../css/customize-controls.' . $opt . 'css', __FILE__ ), array(), null, 'all' );
                wp_enqueue_style( 'font-awesome-style', '//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css', array(), null, 'all' );
                wp_enqueue_style( 'icustomize-codemirror-search-matchesonscrollbar-style', '//cdnjs.cloudflare.com/ajax/libs/codemirror/5.11.0/addon/search/matchesonscrollbar.min.css', array(), null, 'all' );
            }
        }
        add_action( 'admin_enqueue_scripts', 'icustomize_control_enqueue' );
    }
