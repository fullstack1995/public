<?php defined( 'ABSPATH' ) or die;

class InfoJob_Admin_Menus
{
	public static function init(): void
    {
		add_action( 'admin_menu', [__CLASS__ , 'register'] );
	}

	public static function register(): void
    {
        add_submenu_page(
            'edit.php?post_type=advertising',
            __( 'Importer', 'infojob' ),
            __( 'Importer', 'infojob' ),
            'manage_options',
            'infojob-importer',
            [__CLASS__, 'importer']
        );

        add_submenu_page(
            'edit.php?post_type=advertising',
            __( 'Settings', 'infojob' ),
            __( 'Settings', 'infojob' ),
            'manage_options',
            'infojob-settings',
            [__CLASS__, 'settings']
        );
	}

    public static function importer(): void
    {
        include INFOJOB_TEMPLATES . 'admin/importer.php';
    }

    public static function settings(): void
    {
        if( isset( $_POST['submit'] ) )
        {
            unset( $_POST['submit'] );

            update_option( 'infojob', $_POST );
        }

        $options = get_option( 'infojob', [] );

        include INFOJOB_TEMPLATES . 'admin/settings.php';
    }
}

InfoJob_Admin_Menus::init();