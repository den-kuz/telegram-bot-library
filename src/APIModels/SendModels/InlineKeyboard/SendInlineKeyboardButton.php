<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 19.07.2016
 * Time: 22:53
 */

namespace TelegramBotLibrary\APIModels\SendModels\InlineKeyboard;


use TelegramBotLibrary\APIModels\BaseModels\BaseSendModel;

class SendInlineKeyboardButton extends BaseSendModel
{
    public $text;
    public $url;
    public $callback_data;
    public $switch_inline_query;

    protected function configure ( $data )
    {
        // TODO: Implement configure() method.
    }
}