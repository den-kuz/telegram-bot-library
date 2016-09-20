<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:25
 */

namespace TelegramBotLibrary\APIModels\SendModels\ReplyKeyboard;


use TelegramBotLibrary\APIModels\BaseModels\BaseSendModel;

class ReplyKeyboardMarkupSend extends BaseSendModel
{
    public $keyboard;

    public $resize_keyboard;

    public $one_time_keyboard;

    public $selective;

    public function addKeyBoardRow ( $row )
    {
        $this->keyboard[] = $row;
    }

    public function toArray ()
    {
        return json_encode( parent::toArray() );
    }

    protected function configure ( $data )
    {
        // TODO: Implement configure() method.
    }
}