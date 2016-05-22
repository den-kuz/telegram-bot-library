<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:13
 */

namespace TelegramBotLibrary\APIModels\BaseModels;

abstract class SendBaseModel extends BaseModel
{
    public $disable_notification;
    public $reply_to_message_id;
    public $reply_markup;
}