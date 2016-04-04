<?php
/*
* Template Use: ic-script to enqueue master scripts on front-end
*
* Example: http://www.yourserver.com/wp-content/plugins/icustomize/inc/assets/ic-script-master.php?key=icustomize-master-js-betheme
*
*/

//let's define our servers base path and include wp functions
$base_dir = $_SERVER['DOCUMENT_ROOT'];
define('WP_USE_THEMES', false);
require($base_dir . '/wp-blog-header.php');

//get master js
$ic_options = get_option('icustomize');
$key = $_GET['key'];
$master_js = $ic_options[$key];

//get script data and escape quotes
$js = html_entity_decode( esc_attr( $master_js ), ENT_QUOTES, 'UTF-8');

//define as javascript doc
header("Content-type: text/javascript; charset: UTF-8");

//output our script
echo $js;