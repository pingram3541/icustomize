<?php
/*
* Template Use: ic-style to enqueue master styles on front-end
*
* Produces: http://www.yourserver.com/wp-content/plugins/icustomize/inc/assets/ic-style.php?key=icustomize-master-css-yourtheme
*
*/

$css = ''; /* initialize */

//server base path and include wp functions
$base_dir = $_SERVER['DOCUMENT_ROOT'];
define('WP_USE_THEMES', false);
require($base_dir . '/wp-blog-header.php');

//get and return master css
if( isset($_GET['key']) ){
    
    $ic_options = get_option('icustomize');
    
    $key = $_GET['key'];
    
    $master_css = $ic_options[$key];
    
    //get style data and escape quotes
    $css = html_entity_decode( esc_attr( $master_css ), ENT_QUOTES, 'UTF-8');
    
}

//define as stylesheet doc
header("Content-type: text/css; charset: UTF-8");

//output our styles
echo '/* icustomize site-wide master css */';

echo $css;