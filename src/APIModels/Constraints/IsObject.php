<?php

namespace TelegramBotLibrary\APIModels\Constraints;

use TelegramBotLibrary\APIModels\Interfaces\ConstraintInterface;

class IsObject implements ConstraintInterface
{
    protected $class;

    public function __construct ( $class = null )
    {
        $this->class = $class;
    }

    public function isValid ( $dataValue )
    {
        if ( !is_object( $dataValue ) ) return false;

        if ( $this->class ) {
            if ( !( $dataValue instanceof $this->class ) ) {
                return false;
            }

            if ( method_exists( $dataValue, 'validateConstraints' ) ) $dataValue->validateConstraints();
        }

        return true;
    }

    public function getDescription ()
    {
        $description = 'object';
        if ( $this->class ) {
            $description .= ' with class "' . $this->class . '"';
        }

        return $description;
    }
}