<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:24
 */

namespace TelegramBotLibrary\APIModels\SendTypes;

use TelegramBotLibrary\APIModels\BaseModels\SendFileBaseModel;

class SendPhoto extends SendFileBaseModel
{
    public $chat_id;
    public $photo;
    public $caption;
}