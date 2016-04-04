<?php
/**
 * Customizer Front-End
 *
 * @package     iCustomize
 * @category    Core
 * @author      wplovr
 * @copyright   Copyright (c) 2016, Philip Ingram, wplovr, wplovr.com
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       0.1
 * 
 * @todo        enqueue front end outside of customizer
 *              see https://wordpress.org/support/topic/best-way-to-create-a-css-file-dynamically
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
    
    /* ---------------------------------------------------------------------------
     * Add Master and Custom Page Specific Stylesheets
     * --------------------------------------------------------------------------- */
    if( ! function_exists( 'icustomize_custom_css_back' ) ) {
        
        function icustomize_custom_css_back() {
            
            global $post;
            global $wp_customize;
            
            if ( isset( $_REQUEST['wp_customize'] ) ) { //$_REQUEST['wp_customize']
            
                //get our master options
                $ic_options = get_option('icustomize');
                $key = 'icustomize-master-css-' . CURRENT_THEME_NAME;
                $master_css = $ic_options[$key];
                
                //output our master css
    		    echo '<style type="text/css" id="icustomize-master-css-' . CURRENT_THEME_NAME . '">'."\n";
    			    echo $master_css ."\n";
    		    echo '</style>'."\n";
    		    
    		    
    		    //get our post/page css
                $id = $post->ID;
                $page_css = get_post_meta( $id, 'icustomize-page-css-' . CURRENT_THEME_NAME, true);
                
                //output our page css
    		    echo '<style type="text/css" id="icustomize-page-css-' . CURRENT_THEME_NAME . '">'."\n";
    			    echo $page_css ."\n";
    		    echo '</style>'."\n";
    		    
            } else {
                echo '<link rel="stylesheet" type="text/css" id="icustomize-master-css-' . CURRENT_THEME_NAME. '" href="/wp-content/plugins/icustomize/inc/assets/ic-style-master.php?key=icustomize-master-css-' . CURRENT_THEME_NAME . '">';
                echo '<link rel="stylesheet" type="text/css" id="icustomize-page-css-' . CURRENT_THEME_NAME. '" href="/wp-content/plugins/icustomize/inc/assets/ic-style-page.php?id=' . $post->ID . '&key=icustomize-page-css-' . CURRENT_THEME_NAME . '">';
            }
        }
        
    }
    add_action('wp_head', 'icustomize_custom_css_back', 999999);
    
    
    /* ---------------------------------------------------------------------------
     * Add Master and Custom Specific Scripts in customizer
     * --------------------------------------------------------------------------- */
    if( ! function_exists( 'icustomize_custom_js_back' ) ) {
        
        function icustomize_custom_js_back() {
            
            global $post;
            global $wp_customize;
            
            if ( isset( $_REQUEST['wp_customize'] ) ) { //$_REQUEST['wp_customize']
            
                //get our master options
                $ic_options = get_option('icustomize');
                $key = 'icustomize-master-js-' . CURRENT_THEME_NAME;
                $master_js = $ic_options[$key];
                
                //output our master css
    		    echo '<script type="text/javascript" id="icustomize-master-js-' . CURRENT_THEME_NAME . '">'."\n";
    		        echo $master_js ."\n";
    		    echo '</script>'."\n";
    		    
    		    
    		    //get our post/page js
                $id = $post->ID;
                $page_js = get_post_meta( $id, 'icustomize-page-js-' . CURRENT_THEME_NAME, true);
                
                //output our page css
    		    echo '<script type="text/javascript" id="icustomize-page-js-' . CURRENT_THEME_NAME . '">'."\n";
    		        echo $page_js ."\n";
    		    echo '</script>'."\n";
		    
            } else {
                echo '<script type="text/javascript" id="icustomize-master-js-' . CURRENT_THEME_NAME. '" src="/wp-content/plugins/icustomize/inc/assets/ic-script-master.php?key=icustomize-master-js-' . CURRENT_THEME_NAME . '"></script>';
                echo '<script type="text/javascript" id="icustomize-page-js-' . CURRENT_THEME_NAME. '" src="/wp-content/plugins/icustomize/inc/assets/ic-script-page.php?id=' . $post->ID . '&key=icustomize-page-js-' . CURRENT_THEME_NAME . '"></script>';  
            }
        }
        
    }
    add_action('wp_footer', 'icustomize_custom_js_back', 999999);
