<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:04
 */

namespace TelegramBotLibrary\APIModels\BaseTypes;


use TelegramBotLibrary\APIModels\BaseModels\BaseModel;
use TelegramBotLibrary\APIModels\BaseModels\CreateWithTypes;

class MessageEntity extends BaseModel
{
    /**
     * @var string
     */
    public $type;

    /**
     * @var integer
     */
    public $offset;

    /**
     * @var integer
     */
    public $length;

    /**
     * @var string
     */
    public $url;

    /**
     * @var User
     */
    public $user;

    protected function configure ( $data )
    {
        $this
            ->setCreateWithConfiguration( 'type', CreateWithTypes::Scalar, 'string' )
            ->setCreateWithConfiguration( 'offset', CreateWithTypes::Scalar, 'integer' )
            ->setCreateWithConfiguration( 'length', CreateWithTypes::Scalar, 'integer' )
            ->setCreateWithConfiguration( 'url', CreateWithTypes::Scalar, 'string' )
            ->setCreateWithConfiguration( 'user', CreateWithTypes::Object, User::class );
    }

    public function getValueFromText ( $text )
    {
        return mb_substr( $text, $this->offset, $this->length );
    }

    public function getValueClearCommand ( $text )
    {
        $val = $this->getValueFromText( $text );
        $splitCommand = explode( '@', $val );

        return $splitCommand[ 0 ];
    }

    public function getTextAfterEntity ( $text, $trim = true )
    {
        $result = mb_substr( $text, $this->offset + $this->length, mb_strlen( $text ) );

        if ( $trim ) {
            $result = trim( $result );
        }

        return $result;
    }

    public function getTextBeforeEntity ( $text, $trim = true )
    {
        $result = mb_substr( $text, 0, $this->offset );

        if ( $trim ) {
            $result = trim( $result );
        }

        return $result;
    }
}