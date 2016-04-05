<?php
/*
* Template Use: ic-style to enqueue page-specific styles on front-end
*
* Produces: http://www.yourserver.com/wp-content/plugins/icustomize/inc/assets/ic-style-page.php?id=429&key=icustomize-master-css-yourtheme
*
*/

//let's define our servers base path and include wp functions
$base_dir = $_SERVER['DOCUMENT_ROOT'];
define('WP_USE_THEMES', false);
require($base_dir . '/wp-blog-header.php');

//get post id
$post_id = intval($_GET['id']);
$key = $_GET['key'];

//get all post meta - probably a better way use get_post_meta instead
$meta = get_post_custom( $post_id );

//get style data and escape quotes
$css = html_entity_decode( esc_attr( $meta[$key][0] ), ENT_QUOTES, 'UTF-8' );

//define as stylesheet doc
header("Content-type: text/css; charset: UTF-8");

//output our styles
echo $css;
