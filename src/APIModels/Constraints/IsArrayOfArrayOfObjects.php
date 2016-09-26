<?php

namespace TelegramBotLibrary\APIModels\Constraints;

class IsArrayOfArrayOfObjects extends IsArrayOfObjects
{
    public function isValid ( $dataValue )
    {
        if ( !is_array( $dataValue ) ) return false;

        foreach ( $dataValue as $parentKey => $parentValue ) {
            if ( !parent::isValid( $parentValue ) ) {
                return false;
            }
        }

        return true;
    }

    public function getDescription ()
    {
        $description = 'array of array of objects';
        if ( $this->class ) {
            $description .= ' with class ' . $this->class;
        }

        return $description;
    }
}