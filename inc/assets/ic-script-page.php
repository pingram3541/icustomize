<?php
/*
* Template Use: ic-script to enqueue page-specific scripts on front-end
*
* Produces: http://www.yourserver.com/wp-content/plugins/icustomize/inc/assets/ic-script-page.php?id=429&key=icustomize-master-js-yourtheme
*
*/

//let's define our servers base path and include wp functions
$base_dir = $_SERVER['DOCUMENT_ROOT'];
define('WP_USE_THEMES', false);
require($base_dir . '/wp-blog-header.php');

//get post id
$post_id = $_GET['id'];
$key = $_GET['key'];

//get all post meta - probably a better way use get_post_meta instead
$meta = get_post_custom( $post_id );

//get script data and escape quotes
$js = html_entity_decode( esc_attr( $meta[$key][0] ), ENT_QUOTES, 'UTF-8' );

//define as javascript doc
header("Content-type: text/javascript; charset: UTF-8");

//output our script
echo $js;