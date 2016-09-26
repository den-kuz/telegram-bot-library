<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 23:37
 */

namespace TelegramBotLibrary\APIModels\BaseTypes;

use TelegramBotLibrary\APIModels\BaseModels\CreateType;
use TelegramBotLibrary\APIModels\BaseModels\MapDataModel;
use TelegramBotLibrary\APIModels\Enums\ScalarCreateTypes;
use TelegramBotLibrary\APIModels\Enums\SystemCreateTypes;

class ChatMember extends MapDataModel
{
    /**
     * @var User
     */
    public $user;

    /**
     * @var string
     */
    public $status;



    protected function configure ( $data )
    {
        $this
            ->setCreateType( 'user', new CreateType( SystemCreateTypes::Object, User::class ) )
            ->setCreateType( 'status', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::STRING ) );

        return $this;
    }
}