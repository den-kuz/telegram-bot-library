<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:19
 */

namespace TelegramBotLibrary\APIModels\SendTypes\ReplyKeyboard;

use TelegramBotLibrary\APIModels\BaseModels\SendBaseModel;

class SendForceReply extends SendBaseModel
{
    public $force_reply = true;
    public $selective;

    public function convertToQuery() {
        $arr = parent::convertToQuery();
        return json_encode($arr);
    }
}