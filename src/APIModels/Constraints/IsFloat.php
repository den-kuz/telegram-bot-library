<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 23.09.2016
 * Time: 18:12
 */

namespace TelegramBotLibrary\APIModels\Constraints;

use TelegramBotLibrary\APIModels\Interfaces\ConstraintInterface;

class IsFloat implements ConstraintInterface
{
    protected $strict;

    public function __construct ( $strict = false )
    {
        $this->strict = $strict;
    }

    public function isValid ( $dataValue )
    {
        if ( is_float( $dataValue ) || is_int( $dataValue ) ) return true;

        if ( !$this->strict ) {
            return $this->isStringFloat( $dataValue );
        }

        return false;
    }

    public function isStringFloat ( $dataValue )
    {
        if ( !is_string( $dataValue ) ) return false;

        return ( (string)floatval( $dataValue ) == $dataValue );
    }

    public function getDescription ()
    {
        if ( $this->strict ) {
            return 'float (strict)';
        }

        return 'float or string float';
    }
}