<?php
/**
 * Customizer Front-End
 *
 * @package     iCustomize
 * @category    Core
 * @author      wplovr
 * @copyright   Copyright (c) 2016, Philip Ingram, wplovr, wplovr.com
 * @license     http://www.gnu.org/licenses/gpl-3.0.en.html
 * @since       0.01
 *
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

    /* ---------------------------------------------------------------------------
     * Front-End Filters to load dynamic CSS as separate stylesheets
     * --------------------------------------------------------------------------- */
    add_filter('query_vars','icustomize_get_css');
    function icustomize_get_css($vars) {
        $vars[] = 'get_css';
        return $vars;
    }

    /* ---------------------------------------------------------------------------
     * Front-End Actions to execute loading of dynamic CSS from URL queries
     * --------------------------------------------------------------------------- */
    add_action('template_redirect', 'icustomize_set_css');
    function icustomize_set_css() {

        $ic_options = get_option('icustomize');

        /* --------------------------------------------
         * Site-Wide Master CSS
         * ------------------------------------------ */
        if( get_query_var('get_css') == 'master') {

            $master_css = '/* no master css styles set' . '*/'; //set default

            //get our master css from $pre_options
            $master_key = 'icustomize-master-css-' . CURRENT_THEME_NAME;
            if( isset($ic_options[$master_key]) )
                $master_css = $ic_options[$master_key];

            //define as stylesheet type document
            header("Content-type: text/css; charset: UTF-8");

            //output master css
            echo $master_css ."\n";

            exit;
        }

        /* --------------------------------------------
         * Shop-Wide Master CSS
         * ------------------------------------------ */
        if( get_query_var('get_css') == 'shop' ) {

            $shop_css = '/* no shop css styles set' . '*/'; //set default

            //get our shop master css from $pre_ options
            $shop_key = 'icustomize-wc-master-css-' . CURRENT_THEME_NAME;
            if( isset($ic_options[$shop_key]) )
                $shop_css = $ic_options[$shop_key];

            //define as stylesheet type document
            header("Content-type: text/css; charset: UTF-8");

            //output shop css
            echo $shop_css ."\n";

            exit;
        }

        /* --------------------------------------------
         * Page-Specific CSS
         * ------------------------------------------ */
        if( get_query_var('get_css') == 'page' ) {

            $page_css = '/* no page css styles set' . '*/'; //set default

            //get our post/page css
            if( isset($_GET['id']) )
                $id = $_GET['id'];

            if ( ! empty(get_post_meta( $id, 'icustomize-page-css-' . CURRENT_THEME_NAME, true)) )
                $page_css = get_post_meta( $id, 'icustomize-page-css-' . CURRENT_THEME_NAME, true);

            //define as stylesheet type document
            header("Content-type: text/css; charset: UTF-8");

            //output page css
            echo $page_css ."\n";

            exit;
        }

    }

    /* ---------------------------------------------------------------------------
     * Add Master and Custom Page Specific Stylesheets via wp_head
     * --------------------------------------------------------------------------- */
    add_action('wp_head', 'icustomize_custom_css_back', 999999);
    if( ! function_exists( 'icustomize_custom_css_back' ) ) {

        function icustomize_custom_css_back() {

            global $post;
            global $wp_customize;

            if( isset( $post->ID ) ){
                $id = $post->ID;
            }

            if ( isset( $_REQUEST['wp_customize'] ) ) {

                //get our master options
                $ic_options = get_option('icustomize');
                $key = 'icustomize-master-css-' . CURRENT_THEME_NAME;
                $master_css = $ic_options[$key];

                //output our master css
    		    echo '<style type="text/css" id="icustomize-master-css-' . CURRENT_THEME_NAME . '">'."\n";
    			    echo $master_css ."\n";
    		    echo '</style>'."\n";


    		    //get our shop master options
    		    if ( class_exists( 'woocommerce' ) && (is_woocommerce() || is_cart() || is_checkout() ) ) {
                    $shop_key = 'icustomize-wc-master-css-' . CURRENT_THEME_NAME;
                    $shop_master_css = $ic_options[$shop_key];

                    //output our shop's master css
        		    echo '<style type="text/css" id="icustomize-wc-master-css-' . CURRENT_THEME_NAME . '">'."\n";
        			    echo $shop_master_css ."\n";
        		    echo '</style>'."\n";
    		    }

    		    if( is_singular() ){
    		        //get our post/page css
                    $page_css = get_post_meta( $id, 'icustomize-page-css-' . CURRENT_THEME_NAME, true);

                    //output our page css
        		    echo '<style type="text/css" id="icustomize-page-css-' . CURRENT_THEME_NAME . '">'."\n";
    			       echo $page_css ."\n";
    		        echo '</style>'."\n";
    		    }

            } else {

                //master css
                echo '<link rel="stylesheet" type="text/css" id="icustomize-master-css-' . CURRENT_THEME_NAME. '" href="/?get_css=master">';

                //shop css
                if ( class_exists( 'woocommerce' ) && (is_woocommerce() || is_cart() || is_checkout() ) ) {
                    echo '<link rel="stylesheet" type="text/css" id="icustomize-wc-master-css-' . CURRENT_THEME_NAME. '" href="/?get_css=shop">';
                }

                //page css
                if( is_singular() ){
                    echo '<link rel="stylesheet" type="text/css" id="icustomize-page-css-' . CURRENT_THEME_NAME. '" href="/?get_css=page&id=' . $id . '">';
                }
            }
        }

    }



    /* ---------------------------------------------------------------------------
     * Front-End Filters to load dynamic JS as separate scripts
     * --------------------------------------------------------------------------- */
    add_filter('query_vars','icustomize_get_js');
    function icustomize_get_js($vars) {
        $vars[] = 'get_js';
        return $vars;
    }

    /* ---------------------------------------------------------------------------
     * Front-End Actions to execute loading of dynamic JS from URL queries
     * --------------------------------------------------------------------------- */
    add_action('template_redirect', 'icustomize_set_js');
    function icustomize_set_js() {

        $ic_options = get_option('icustomize');

        /* --------------------------------------------
         * Site-Wide Master JS
         * ------------------------------------------ */
        if( get_query_var('get_js') == 'master') {

            $master_js = '/* no master scripts set' . '*/'; //set default

            //get our master js from $pre_options
            $master_key = 'icustomize-master-js-' . CURRENT_THEME_NAME;
            if( isset($ic_options[$master_key]) )
                $master_js = $ic_options[$master_key];

            //define as javascript type document
            header("Content-type: text/javascript; charset: UTF-8");

            //output master js
            echo $master_js ."\n";

            exit;
        }

        /* --------------------------------------------
         * Shop-Wide Master JS
         * ------------------------------------------ */
        if( get_query_var('get_js') == 'shop' ) {

            $shop_js = '/* no shop scripts set' . '*/'; //set default

            //get our shop master js from $pre_ options
            $shop_key = 'icustomize-wc-master-js-' . CURRENT_THEME_NAME;
            if( isset($ic_options[$shop_key]) )
                $shop_js = $ic_options[$shop_key];

            //define as javascript type document
            header("Content-type: text/javascript; charset: UTF-8");

            //output shop js
            echo $shop_js ."\n";

            exit;
        }

        /* --------------------------------------------
         * Page-Specific JS
         * ------------------------------------------ */
        if( get_query_var('get_js') == 'page' ) {

            $page_js = '/* no page scripts set' . '*/'; //set default

            //get our post/page css
            if( isset($_GET['id']) )
                $id = $_GET['id'];

            if ( ! empty(get_post_meta( $id, 'icustomize-page-js-' . CURRENT_THEME_NAME, true)) )
                $page_js = get_post_meta( $id, 'icustomize-page-js-' . CURRENT_THEME_NAME, true);

            //define as javascript type document
            header("Content-type: text/javascript; charset: UTF-8");

            //output page js
            echo $page_js ."\n";

            exit;
        }

    }


    /* ---------------------------------------------------------------------------
     * Add Master and Custom Specific Scripts in customizer via wp_footer
     * --------------------------------------------------------------------------- */
    if( ! function_exists( 'icustomize_custom_js_back' ) ) {

        function icustomize_custom_js_back() {

            global $post;
            global $wp_customize;

            if( isset( $post->ID ) ){
                $id = $post->ID;
            }

            if ( isset( $_REQUEST['wp_customize'] ) ) {

                //get our master options
                $ic_options = get_option('icustomize');
                $key = 'icustomize-master-js-' . CURRENT_THEME_NAME;
                $master_js = $ic_options[$key];

                //output our master css
    		    echo '<script type="text/javascript" id="icustomize-master-js-' . CURRENT_THEME_NAME . '">'."\n";
    		        echo $master_js ."\n";
    		    echo '</script>'."\n";


    		    //get our shop master options
    		    if ( class_exists( 'woocommerce' ) && ( is_woocommerce() || is_cart() || is_checkout() ) ) {
                    $shop_key = 'icustomize-wc-master-js-' . CURRENT_THEME_NAME;
                    $shop_master_js = $ic_options[$shop_key];

                    //output our shop's master css
        		    echo '<script type="text/javascript" id="icustomize-wc-master-js-' . CURRENT_THEME_NAME . '">'."\n";
        		        echo $shop_master_js ."\n";
        		    echo '</script>'."\n";
    		    }


    		    //get our post/page js
    		    if( is_singular() ){
                    $page_js = get_post_meta( $id, 'icustomize-page-js-' . CURRENT_THEME_NAME, true);

                    //output our page css
        		    echo '<script type="text/javascript" id="icustomize-page-js-' . CURRENT_THEME_NAME . '">'."\n";
        		        echo $page_js ."\n";
        		    echo '</script>'."\n";
    		    }

            } else {

                //master js
                echo '<script type="text/javascript" id="icustomize-master-js-' . CURRENT_THEME_NAME. '" src="/?get_js=master"></script>';

                //shop js
                if ( class_exists( 'woocommerce' ) && (is_woocommerce() || is_cart() || is_checkout() ) ) {
                    echo '<script type="text/javascript" id="icustomize-wc-master-js-' . CURRENT_THEME_NAME. '" src="/?get_js=shop"></script>';
                }

                //page js
                if( is_singular() ){
                    echo '<script type="text/javascript" id="icustomize-page-js-' . CURRENT_THEME_NAME. '" src="/?get_js=page&id=' . $id . '"></script>';
                }
            }
        }

    }
    add_action('wp_footer', 'icustomize_custom_js_back', 999999);


    //future types
    /*if( class_exists('Woocommerce') ){

            if( is_shop() ){
                write_log('shop page');
            }

            /*
            if( is_cart() ){
                write_log('cart page');
            }

            if( is_checkout() ){
                write_log('checkout page');
            }

            if( is_account_page() ){
                write_log('account page');
            }

            if( is_filtered() ){
                write_log('shop filtered page');
            }

            if( is_product() ){
                write_log('product page');
            }

            if( is_product_category() ){
                write_log('product category page');
            }

            if( is_product_tag() ){
                write_log('product tag page');
            }

            if( is_product_taxonomy() ){
                write_log('product tag page');
            }

            if( is_view_order_page() ){
                write_log('view order page');
            }
        }*/
