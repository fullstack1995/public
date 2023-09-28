<?php defined( 'ABSPATH' ) or die;

class InfoJob_Shortcodes
{
    public static array $shortcodes = [
        'infojob-search-form'  => 'search_form',
        'infojob-search-result'  => 'search_result',
    ];

    public static function init(): void
    {
        add_action( 'init', [__CLASS__, 'register'] );
    }

    public static function register(): void
    {
        foreach( self::$shortcodes as $shortcode => $function ) 
        {
            add_shortcode( $shortcode,  __CLASS__ . '::' . $function );
        }
    }

    public static function search_form(): string
    {
        wp_enqueue_script( 'infojob-search-form' );

        ob_start();

        include INFOJOB_TEMPLATES . 'shortcodes/search-form.php';

        return ob_get_clean();
    }

    public static function search_result(): string
    {
        wp_enqueue_script( 'infojob-search-form' );

        ob_start();

        include INFOJOB_TEMPLATES . 'shortcodes/search-result.php';

        return ob_get_clean();
    }

}

InfoJob_Shortcodes::init();