<?php

namespace TelegramBotLibrary\APIModels\Constraints;

use TelegramBotLibrary\APIModels\Interfaces\ConstraintInterface;

class IsInteger implements ConstraintInterface
{
    protected $strict;

    public function __construct ( $strict = false )
    {
        $this->strict = $strict;
    }

    public function isValid ( $dataValue )
    {
        if ( is_int( $dataValue ) ) return true;

        if ( !$this->strict ) {
            return $this->isStringInteger( $dataValue );
        }

        return false;
    }

    public function isStringInteger ( $dataValue )
    {
        if ( !is_string( $dataValue ) ) return false;
        if ( !is_numeric( $dataValue ) ) return false;

        return ( (string)intval( $dataValue ) == $dataValue );
    }

    public function getDescription ()
    {
        return 'integer ' . ( $this->strict ? '(strict)' : 'or string integer' );
    }
}