<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:20
 */

namespace TelegramBotLibrary\APIModels\SendTypes;


use TelegramBotLibrary\APIModels\BaseModels\SendBaseModel;

class SendForwardMessage extends SendBaseModel
{
    public $chat_id;
    public $from_chat_id;
    public $message_id;
}