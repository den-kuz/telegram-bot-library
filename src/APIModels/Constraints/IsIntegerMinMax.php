<?php

namespace TelegramBotLibrary\APIModels\Constraints;

class IsIntegerMinMax extends IsInteger
{
    protected $minValue = PHP_INT_MIN;

    protected $maxValue = PHP_INT_MAX;

    public function __construct ( $minValue = PHP_INT_MIN, $maxValue = PHP_INT_MAX, $strict = false )
    {
        parent::__construct( $strict );

        $this->minValue = $minValue;
        $this->maxValue = $maxValue;
    }

    public function isValid ( $dataValue )
    {
        if ( parent::isValid( $dataValue ) ) {
            $dataValue = intval( $dataValue );

            return ( ( $dataValue >= $this->minValue ) && ( $dataValue <= $this->maxValue ) );
        }

        return false;
    }

    public function getDescription ()
    {
        return parent::getDescription() . ' >= ' . $this->minValue . ' && <= ' . $this->maxValue;
    }
}