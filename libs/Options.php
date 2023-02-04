<?php
namespace Weberwin\Libs;

class Options{

    public static $option_name = 'custom_plugin_name';

    public static function get_option_name(){
        return self::$option_name;
    }

    public static function set_option_name( $new_option_name ){
        return self::$option_name = $new_option_name;
    }

    /**
     * 
     * @param string $option, 
     * @param mixed $value
     * 
     * return bool 
     * 
     */

    public static function save_options( string $option , $value ){
        $options = self::get_options();

        if( !$options ) return self::create_new_options( $option , $value );

        $options[ $option ] = $value;

        return update_option( self::$option_name , $options );
    }

    /**
     * 
     * return array || false
     * 
     */

    public static function get_options(){
        return get_option( self::$option_name , false );
    }

    /**
     * 
     * @param string $option_name
     * 
     * Get option from option array from wp_options
     * 
     * return bool || mixed value
     */

    public static function get_single_option( string $option_name ){
        $options = self::get_options();

        if( !isset( $options ) ) return false;
        if( !isset( $options[ $option_name ] ) ) return false;

        return $options[ $option_name ];
    }

    /**
     * @param string $option
     * @param mixed $value
     * 
     * Create new option
     * return bool
     * 
     */

    public static function create_new_options( string $option , $value){
        $new_option[ $option ] = $value;

        return update_option( self::$option_name , $new_option);
    }


    public static function delete_option( string $delete_option ){
        $options = self::get_options();

        unset( $options[ $delete_option ] );
        return update_option( self::$option_name , $options );
    }
}