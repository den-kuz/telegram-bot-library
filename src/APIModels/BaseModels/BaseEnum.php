<?php

namespace TelegramBotLibrary\APIModels\BaseModels;

use ReflectionClass;

abstract class BaseEnum
{
    public static function getConstList ( $firstPosFilter = null )
    {
        $reflect = new ReflectionClass( static::class );
        $consts = $reflect->getConstants();

        if ( $firstPosFilter && is_string( $firstPosFilter ) ) {
            $consts = array_filter(
                $consts,
                function ( $value, $name ) use ( $firstPosFilter ) {
                    return ( mb_strpos( mb_strtolower( $name ), mb_strtolower( $firstPosFilter ) ) === 0 );
                },
                ARRAY_FILTER_USE_BOTH
            );
        }

        return $consts;
    }

    public static function isValidName ( $name, $strict = false )
    {
        $names = array_keys( self::getConstList() );

        return in_array( $name, $names, $strict );
    }

    public static function isValidValue ( $value, $strict = true )
    {
        $values = array_values( self::getConstList() );

        return in_array( $value, $values, $strict );
    }
}