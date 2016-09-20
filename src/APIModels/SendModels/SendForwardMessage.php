<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:20
 */

namespace TelegramBotLibrary\APIModels\SendModels;


use TelegramBotLibrary\APIModels\BaseModels\BaseSendModel;

class SendForwardMessage extends BaseSendModel
{
    public $chat_id;
    public $from_chat_id;
    public $message_id;

    protected function configure ( $data )
    {
        // TODO: Implement configure() method.
    }
}