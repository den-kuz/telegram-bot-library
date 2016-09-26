<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:04
 */

namespace TelegramBotLibrary\APIModels\BaseTypes;

use TelegramBotLibrary\APIModels\BaseModels\CreateType;
use TelegramBotLibrary\APIModels\BaseModels\MapDataModel;
use TelegramBotLibrary\APIModels\Enums\ScalarCreateTypes;
use TelegramBotLibrary\APIModels\Enums\SystemCreateTypes;

class MessageEntity extends MapDataModel
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

    public function getValueClearCommand ( $text )
    {
        $val = $this->getValueFromText( $text );
        $splitCommand = explode( '@', $val );

        return $splitCommand[ 0 ];
    }

    public function getValueFromText ( $text )
    {
        return mb_substr( $text, $this->offset, $this->length );
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



    protected function configure ( $data )
    {
        $this
            ->setCreateType( 'type', new CreateType ( SystemCreateTypes::Scalar, ScalarCreateTypes::STRING ) )
            ->setCreateType( 'offset', new CreateType ( SystemCreateTypes::Scalar, ScalarCreateTypes::INTEGER ) )
            ->setCreateType( 'length', new CreateType ( SystemCreateTypes::Scalar, ScalarCreateTypes::INTEGER ) )
            ->setCreateType( 'url', new CreateType ( SystemCreateTypes::Scalar, ScalarCreateTypes::STRING ) )
            ->setCreateType( 'user', new CreateType ( SystemCreateTypes::Object, User::class ) );

        return $this;
    }
}