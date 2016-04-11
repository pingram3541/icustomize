<?php
/*
* Template Use: ic-script to enqueue master scripts on front-end
*
* Produces: http://www.yourserver.com/wp-content/plugins/icustomize/inc/assets/ic-script-master.php?key=icustomize-master-js-yourtheme
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
    
    if( isset($ic_options[$key]) ){
        $master_js = $ic_options[$key];
        
        //get script data and escape quotes
        $js = html_entity_decode( esc_attr( $master_js ), ENT_QUOTES, 'UTF-8');
    }
}

//define as javascript type document
header("Content-type: text/javascript; charset: UTF-8");

//output our script
echo '/* icustomize site-wide master js */';

echo $js;