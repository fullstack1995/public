<?php
/*
Plugin Name: دایرکتوری اینفوجاب
Version:     1.0
Author:      FS
Author URI:  https://t.me/projekhone
*/
defined( 'ABSPATH' ) or die;

define( 'INFOJOB_DIRECTORY', plugin_dir_path( __FILE__ ) );

define( 'INFOJOB_TEMPLATES', plugin_dir_path( __FILE__ ) . 'templates/' );

define( 'INFOJOB_URL', plugin_dir_url( __FILE__ ) );

if( !function_exists( 'get_plugin_data' ) )
{
    require_once ABSPATH . 'wp-admin/includes/plugin.php';
}

define( 'INFOJOB_VERSION', get_plugin_data( __FILE__ )['Version'] );

require 'includes/init.php';

register_activation_hook( __FILE__, function()
{
    global $wpdb;

    $tables = [
        'infojobs' => [
            'id INT NOT NULL AUTO_INCREMENT',
            'center_name VARCHAR(255) NOT NULL',
            'state INT NOT NULL',
            'city VARCHAR(255) NOT NULL',
            'regional_municipality VARCHAR(255) NOT NULL',
            'district VARCHAR(55) NOT NULL',
            'street VARCHAR(255) NOT NULL',
            'building VARCHAR(255) NOT NULL',
            'address TEXT NOT NULL',
            'website VARCHAR(255) NOT NULL',
            'phone1 VARCHAR(255) NOT NULL',
            'phone2 VARCHAR(255) NOT NULL',
            'phone3 VARCHAR(255) NOT NULL',
            'fax VARCHAR(255) NOT NULL',
            'cellphone1 VARCHAR(255) NOT NULL',
            'cellphone2 VARCHAR(255) NOT NULL',
            'email VARCHAR(255) NOT NULL',
            'google_map TEXT NOT NULL',
            'image TEXT NOT NULL',
            'video TEXT NOT NULL',
            'PRIMARY KEY (id)) ENGINE = InnoDB;'
        ]
    ];

    $charset_collate = $wpdb->get_charset_collate();

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

    foreach( $tables as $table => $columns )
    {
        $columns = implode( ',', $columns );

        $sql = "CREATE TABLE {$wpdb->prefix}{$table} ({$columns}) $charset_collate;";

        dbDelta( $sql );
    }
} );

