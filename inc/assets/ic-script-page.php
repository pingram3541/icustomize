<?php
/*
* Template Use: ic-script to enqueue page-specific scripts on front-end
*
* Produces: http://www.yourserver.com/wp-content/plugins/icustomize/inc/assets/ic-script-page.php?id=429&key=icustomize-master-js-yourtheme
*
*/

$js = ''; /* initialize */

//server base path and include wp functions
$base_dir = $_SERVER['DOCUMENT_ROOT'];
define('WP_USE_THEMES', false);
require($base_dir . '/wp-blog-header.php');

//get and return post id
if( isset($_GET['id']) && isset($_GET['key']) ){
    
    $post_id = intval($_GET['id']);
    $key = $_GET['key'];
    
    //get all post meta - probably a better way use get_post_meta instead
    $meta = get_post_custom( $post_id );
    
    //get script data and escape quotes
    if( isset($meta[$key][0]) ){
        $js = html_entity_decode( esc_attr( $meta[$key][0] ), ENT_QUOTES, 'UTF-8' );
    }
    
}

//define as javascript doc
header("Content-type: text/javascript; charset: UTF-8");

//output our script
echo '/* icustomize single-page js */';

echo $js;