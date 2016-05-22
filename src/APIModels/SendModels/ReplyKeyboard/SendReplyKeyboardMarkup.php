<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:25
 */

namespace TelegramBotLibrary\APIModels\SendModels\ReplyKeyboard;


use TelegramBotLibrary\APIModels\BaseModels\SendBaseModel;

class SendReplyKeyboardMarkup extends SendBaseModel
{
    public $keyboard;
    public $resize_keyboard;
    public $one_time_keyboard;
    public $selective;

    public function addKeyBoardRow($row) {
        $this->keyboard[] = $row;
    }

    public function convertToQuery() {
        $arr = parent::convertToQuery();
        return json_encode($arr);
    }
}