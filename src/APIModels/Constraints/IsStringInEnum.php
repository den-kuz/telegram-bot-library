<?php

namespace TelegramBotLibrary\APIModels\Constraints;

use TelegramBotLibrary\Exceptions\TelegramRuntimeException;

class IsStringInEnum extends IsString
{
    protected $array = [];

    protected $strictInArray;

    public function __construct ( $array, $strictInArray = true, $strictString = false )
    {
        $arrayOfString = new IsArrayOfStrings( false );
        if ( !$arrayOfString->isValid( $array ) || empty( $array ) ) {
            throw new TelegramRuntimeException( 'Invalid array' );
        }

        parent::__construct( $strictString );

        $this->array = $array;
        $this->strictInArray = $strictInArray;
        $this->strict = $strictString;
    }

    public function isValid ( $dataValue )
    {
        if ( !parent::isValid( $dataValue ) ) return false;

        return in_array( $dataValue, $this->array, $this->strictInArray );
    }

    public function getDescription ()
    {
        return 'string in array';
    }
}