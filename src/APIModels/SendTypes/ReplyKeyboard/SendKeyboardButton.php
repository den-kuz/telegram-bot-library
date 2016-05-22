<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:22
 */

namespace TelegramBotLibrary\APIModels\SendTypes\ReplyKeyboard;

use TelegramBotLibrary\APIModels\BaseModels\SendBaseModel;

class SendKeyboardButton extends SendBaseModel
{
    public $text;
    public $request_contact;
    public $request_location;
}