<?php

namespace TelegramBotLibrary\APIModels\Constraints;

class IsArrayOfStrings extends IsString
{
    public function __construct ( $strict = false )
    {
        parent::__construct( $strict );
    }

    public function isValid ( $dataValue )
    {
        if ( !is_array( $dataValue ) ) return false;

        foreach ( $dataValue as $parenkKey => $parentValue ) {
            if ( !parent::isValid( $parentValue ) ) {
                return false;
            }
        }

        return true;
    }

    public function getDescription ()
    {
        return 'array of ' . ( $this->strict ? 'strings' : 'any scalar type' );
    }
}