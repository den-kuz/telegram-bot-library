<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:18
 */

namespace TelegramBotLibrary\APIModels\SendModels;

use TelegramBotLibrary\APIModels\BaseModels\BaseSendModel;

class ContactSend extends BaseSendModel
{
    public $chat_id;
    public $phone_number;
    public $first_name;
    public $last_name;

    protected function configure ( $data )
    {
        // TODO: Implement configure() method.
    }
}