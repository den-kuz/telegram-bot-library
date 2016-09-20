<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 19.07.2016
 * Time: 22:51
 */

namespace TelegramBotLibrary\APIModels\SendModels\InlineKeyboard;


use TelegramBotLibrary\APIModels\BaseModels\BaseSendModel;

class SendInlineKeyboardMarkup extends BaseSendModel
{
    public $inline_keyboard;

    public function toArray ()
    {
        return json_encode( parent::toArray() );
    }

    protected function configure ( $data )
    {
        // TODO: Implement configure() method.
    }
}