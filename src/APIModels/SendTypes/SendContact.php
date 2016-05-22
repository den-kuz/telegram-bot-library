<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:18
 */

namespace TelegramBotLibrary\APIModels\SendTypes;


use TelegramBotLibrary\APIModels\BaseModels\SendBaseModel;

class SendContact extends SendBaseModel
{
    public $chat_id;
    public $phone_number;
    public $first_name;
    public $last_name;
}