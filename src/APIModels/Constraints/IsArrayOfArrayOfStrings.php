<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 23.09.2016
 * Time: 20:18
 */

namespace TelegramBotLibrary\APIModels\Constraints;

class IsArrayOfArrayOfStrings extends IsArrayOfStrings
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
        return 'array of ' . parent::getDescription();
    }
}