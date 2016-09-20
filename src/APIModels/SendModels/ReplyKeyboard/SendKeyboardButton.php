<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:22
 */

namespace TelegramBotLibrary\APIModels\SendModels\ReplyKeyboard;

use TelegramBotLibrary\APIModels\BaseModels\BaseSendModel;

class KeyboardButtonSend extends BaseSendModel
{
    public $text;
    public $request_contact;
    public $request_location;

    protected function configure ( $data )
    {
        // TODO: Implement configure() method.
    }
}