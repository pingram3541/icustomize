<?php
/**
 * Plugin Name: iCustomize
 * Plugin URI: http://www.wplovr.com/icustomize
 * Description: Adjust Custom CSS and JS in the Customizer.
 * Version: 0.1
 * Author:  wplovr
 * Author URI: http://wplovr.com/
 * License: GPLv2+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 * Copyright (c) 2016 Philip Ingram, wplovr, wplovr.com
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2 or, at
 * your discretion, any later version, as published by the Free
 * Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 * @package iCustomize
 *
 *
 * V0.1 - Plugin biths into existance!
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define debug - if set to true, loads unminified js/css files
if ( ! defined( 'IC_DEBUG' ) ) {
    define( 'IC_DEBUG', false ); //change to 'true' if needed
}

//Define our current theme
if ( ! defined( 'CURRENT_THEME_NAME' ) ) {
    //get current theme name
	$theme = get_current_theme();
	$theme = strtolower($theme); //lower case
	$theme = preg_replace("/[^a-z0-9_\s-]/", "", $theme); //Make alphanumeric (removes all other characters)
	$theme = preg_replace("/[\s-]+/", " ", $theme); //Clean up multiple dashes or whitespaces
	$theme = preg_replace("/[\s_]/", "-", $theme); //Convert whitespaces and underscore to dash

    define( 'CURRENT_THEME_NAME', $theme );
}

class iCustomize {
    function __construct(){
        add_action( 'admin_init', array( $this, 'check_version' ));

        if( ! self::compatible_version() ){
            return;
        } else {
            $this->load_dependencies();
        }
    }

    function load_dependencies(){

        /**
         * Include Kirki toolbox
         */
        if ( ! class_exists( 'Kirki' ) ) {
            include_once( plugin_dir_path( __FILE__ ) . 'inc/kirki/kirki.php' );
        }

        /**
         * Include Post_Meta_Helper
         */
        if ( ! class_exists( 'iCustomize_Post_Meta_Helper' ) ) {
            include_once plugin_dir_path( __FILE__ ) . 'inc/class-icustomize-post-meta-helper.php';
            $icustomize_queried_post_info = new iCustomize_Post_Meta_Helper();
            $icustomize_queried_post_info->init();
        }

        /**
         * Add frontend assets
         */
        include_once( plugin_dir_path( __FILE__ ) . 'inc/icustomize-frontend.php' );

        /**
         * Add dependencies
         */
        include_once( plugin_dir_path( __FILE__ ) . 'inc/icustomize-depends.php' );

        /**
         * Add config types
         */
        include_once( plugin_dir_path( __FILE__ ) . 'inc/icustomize-configs.php' );

        /**
         * Add panels
         */
        include_once( plugin_dir_path( __FILE__ ) . 'inc/icustomize-panels.php' );

        /**
         * Add sections
         */
        include_once( plugin_dir_path( __FILE__ ) . 'inc/icustomize-sections.php' );

        /**
         * Add fields
         */
        include_once( plugin_dir_path( __FILE__ ) . 'inc/icustomize-fields.php' );
    }

    static function activation_check(){
        if( ! self::compatible_version() ){
            deactivate_plugins( plugin_basename(__FILE__) );
            add_action( 'admin_notices', array( $this, 'disabled_notice' ) );
        }
    }

    function check_version(){
        if( ! self::compatible_version() ){
            if( is_plugin_active( plugin_basename(__FILE__) )){
                deactivate_plugins( plugin_basename(__FILE__) );
                add_action( 'admin_notices', array( $this, 'disabled_notice' ) );
                if( isset( $_GET['activate'] ) ){
                    unset( $_GET['activate'] );
                }
            } else {
                $this->activation_check();
            }
        }
    }

    function disabled_notice(){
        echo '<div class="notice notice-error is-dismissible"><p>' . esc_html__( 'Sorry, iCustomize requires WordPress version 4.4 or higher!', 'icustomize' ) . '</p></div>';
    }

    static function compatible_version(){
        global $wp_version;
        if ( $wp_version < 4.4 ) {
             return false; //plugin is not compatible
        } else {
            return true; //yay, we're good to go
        }
	}
}

global $icustomize;
$icustomize = new iCustomize();

register_activation_hook( __FILE__, array( 'iCustomize', 'activation_check' ) );