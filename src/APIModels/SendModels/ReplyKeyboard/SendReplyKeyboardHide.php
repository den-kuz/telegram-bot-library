<?php

namespace TelegramBotLibrary\APIModels\SendModels\ReplyKeyboard;

use TelegramBotLibrary\APIModels\BaseModels\BaseSendModel;

class SendReplyKeyboardHide extends BaseSendModel
{
    public $hide_keyboard = true;

    public $selective;

    public function toArray ()
    {
        return json_encode( parent::toArray() );
    }

    protected function configure ( $data )
    {
        // TODO: Implement configure() method.
    }
}