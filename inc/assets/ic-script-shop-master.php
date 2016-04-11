<?php
/*
* Template Use: ic-script to enqueue master woocommerce scripts on front-end
*
* Produces: http://www.yourserver.com/wp-content/plugins/icustomize/inc/assets/ic-script-shop-master.php?key=icustomize-wc-master-js-yourtheme
*
*/

$js = ''; /* initialize */

//server base path and include wp functions
$base_dir = $_SERVER['DOCUMENT_ROOT'];
define('WP_USE_THEMES', false);
require($base_dir . '/wp-blog-header.php');

//get and return master js
if( isset($_GET['key']) ){
    
    $ic_options = get_option('icustomize');
    
    $key = $_GET['key'];
    
    $shop_master_js = $ic_options[$key];
    
    //get script data and escape quotes
    $js = html_entity_decode( esc_attr( $shop_master_js ), ENT_QUOTES, 'UTF-8');
    
}

//define as javascript type document
header("Content-type: text/javascript; charset: UTF-8");

//output our script
echo '/* icustomize shop-wide css */';

echo $js;