<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 19.07.2016
 * Time: 22:51
 */

namespace TelegramBotLibrary\APIModels\SendModels\InlineKeyboard;


use TelegramBotLibrary\APIModels\BaseModels\SendBaseModel;

class SendInlineKeyboardMarkup extends SendBaseModel
{
    public $inline_keyboard;

    public function convertToQuery()
    {
        $arr = parent::convertToQuery();
        return json_encode($arr);
    }
}