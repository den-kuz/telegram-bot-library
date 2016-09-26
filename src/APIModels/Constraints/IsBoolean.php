<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 23.09.2016
 * Time: 13:11
 */

namespace TelegramBotLibrary\APIModels\Constraints;

use TelegramBotLibrary\APIModels\Interfaces\ConstraintInterface;

class IsBoolean implements ConstraintInterface
{
    protected $strict;

    public function __construct ( $strict = false )
    {
        $this->strict = $strict;
    }

    public function isValid ( $dataValue )
    {
        if ( is_bool( $dataValue ) ) return true;

        if ( !$this->strict ) {
            if ( is_string( $dataValue ) ) {
                return ( mb_strtolower( $dataValue ) == 'true' || mb_strtolower( $dataValue ) == 'false' );
            }

            if ( is_int( $dataValue ) ) {
                return ( $dataValue === 0 || $dataValue === 1 );
            }
        }

        return false;
    }

    public function getDescription ()
    {
        return $this->strict ? 'boolean (strict)' : 'boolean (or 1/0 int, or true/false string)';
    }
}