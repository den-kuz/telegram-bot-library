<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 19.07.2016
 * Time: 22:59
 */

namespace TelegramBotLibrary\APIModels\BaseTypes;

use TelegramBotLibrary\APIModels\BaseModels\CreateType;
use TelegramBotLibrary\APIModels\BaseModels\MapDataModel;
use TelegramBotLibrary\APIModels\Enums\ScalarCreateTypes;
use TelegramBotLibrary\APIModels\Enums\SystemCreateTypes;

class CallbackQuery extends MapDataModel
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var User
     */
    public $from;

    /**
     * @var Message
     */
    public $message;

    /**
     * @var string
     */
    public $inline_message_id;

    /**
     * @var string
     */
    public $data;



    protected function configure ( $data )
    {
        $this
            ->setCreateType( 'id', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::STRING ) )
            ->setCreateType( 'from', new CreateType( SystemCreateTypes::Object, User::class ) )
            ->setCreateType( 'message', new CreateType( SystemCreateTypes::Object, Message::class ) )
            ->setCreateType( 'inline_message_id', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::STRING ) )
            ->setCreateType( 'data', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::STRING ) );

        return $this;
    }
}