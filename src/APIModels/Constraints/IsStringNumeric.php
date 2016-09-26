<?php

namespace TelegramBotLibrary\APIModels\Constraints;

class IsStringNumeric extends IsString
{
    public function isValid ( $dataValue )
    {
        $isString = parent::isValid( $dataValue );

        if ( $isString ) return is_numeric( (string)$dataValue );

        return false;
    }

    public function getDescription ()
    {
        return 'numeric string';
    }
}