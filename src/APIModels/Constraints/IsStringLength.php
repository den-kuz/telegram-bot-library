<?php

namespace TelegramBotLibrary\APIModels\Constraints;

class IsStringLength extends IsString
{
    protected $minLength = 0;

    protected $maxLength = 0;

    public function __construct ( $minLength = 0, $maxLength, $strict = false )
    {
        parent::__construct( $strict );

        $this->minLength = $minLength < 0 ? 0 : $minLength;
        $this->maxLength = $maxLength < $this->minLength ? $this->minLength : $maxLength;
    }

    public function isValid ( $dataValue )
    {
        if ( !parent::isValid( $dataValue ) ) return false;

        $strLen = mb_strlen( (string)$dataValue );

        return ( ( $strLen >= $this->minLength ) && ( $strLen <= $this->maxLength ) );
    }

    public function getDescription ()
    {
        return parent::getDescription() . ' with strlen between ' . $this->minLength . ' and ' . $this->maxLength;
    }
}