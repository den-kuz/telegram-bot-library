<?php

namespace TelegramBotLibrary\APIModels\Constraints;

use TelegramBotLibrary\APIModels\Interfaces\ConstraintInterface;

class IsString implements ConstraintInterface
{
    protected $strict;

    public function __construct ( $strict = false )
    {
        $this->strict = $strict;
    }

    public function isValid ( $dataValue )
    {
        return $this->strict ? is_string( $dataValue ) : is_scalar( $dataValue );
    }

    public function getDescription ()
    {
        return $this->strict ? 'string' : 'any scalar type';
    }
}