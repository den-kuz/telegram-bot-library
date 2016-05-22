<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:23
 */

namespace TelegramBotLibrary\APIModels\SendTypes;

use TelegramBotLibrary\APIModels\BaseModels\SendBaseModel;

class SendLocation extends SendBaseModel
{
    public $chat_id;
    public $latitude;
    public $longitude;
}