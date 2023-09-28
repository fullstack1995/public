<?php defined( 'ABSPATH' ) or die;

if( !function_exists( 'iss' ) )
{
    function iss( &$context, $name, $default = null ) 
    {
        $pieces = explode( '.', $name );

        foreach( $pieces as $piece ) 
        {
            if( !is_array( $context ) || !array_key_exists( $piece, $context ) )
            {
                return $default;
            }

            $context = &$context[$piece];
        }

        return $context;
    }
}