<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 23:37
 */

namespace TelegramBotLibrary\APIModels\BaseTypes;

use TelegramBotLibrary\APIModels\BaseModels\BaseModel;
use TelegramBotLibrary\APIModels\BaseModels\CreateWithTypes;

class ChatMember extends BaseModel
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
            ->setCreateWithConfiguration( 'user', CreateWithTypes::Object, User::class )
            ->setCreateWithConfiguration( 'status', CreateWithTypes::Scalar, 'string' );
    }
}