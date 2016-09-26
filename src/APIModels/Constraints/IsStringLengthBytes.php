<?php

namespace TelegramBotLibrary\APIModels\Constraints;

class IsStringLengthBytes extends IsString
{
    protected $minBytes = 0;

    protected $maxBytes = 0;

    public function __construct ( $minBytes = 0, $maxBytes, $strict = false )
    {
        parent::__construct( $strict );

        $this->minBytes = $minBytes;
        $this->maxBytes = $maxBytes;
    }

    public function isValid ( $dataValue )
    {
        if ( !parent::isValid( $dataValue ) ) return false;

        $strLen = mb_strlen( $dataValue, '8bit' );

        return ( ( $strLen >= $this->minBytes ) && ( $strLen <= $this->maxBytes ) );
    }

    public function getDescription ()
    {
        return parent::getDescription() . ' with strlen in bytes between ' . $this->minBytes . ' and ' . $this->maxBytes;
    }
}