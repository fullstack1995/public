<?php defined( 'ABSPATH' ) or die;

/* get shop products */
add_action( 'wp_ajax_wp_get_shop_products', function() 
{
    $response = [];

    wp_send_json_success( $response );
} );