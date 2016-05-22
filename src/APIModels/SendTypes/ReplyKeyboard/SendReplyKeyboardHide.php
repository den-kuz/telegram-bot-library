<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:24
 */

namespace TelegramBotLibrary\APIModels\SendTypes\ReplyKeyboard;


use TelegramBotLibrary\APIModels\BaseModels\SendBaseModel;

class SendReplyKeyboardHide extends SendBaseModel
{
    public $hide_keyboard = true;
    public $selective;

    public function convertToQuery() {
        $arr = parent::convertToQuery();
        return json_encode($arr);
    }
}