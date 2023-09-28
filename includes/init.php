<?php defined( 'ABSPATH' ) or die;

foreach( glob( INFOJOB_DIRECTORY . 'includes/classes/*.php' ) as $file )
{
    include $file;
}

if( !class_exists( 'IOFactory' ) )
{
    require_once 'vendor/autoload.php';
}

include 'functions.php';

include 'class-admin-menus.php';

include 'class-shortcodes.php';

include 'ajax-admin.php';

include 'ajax-frontend.php';

include 'hooks.php';