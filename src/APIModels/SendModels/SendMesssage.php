<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:23
 */

namespace TelegramBotLibrary\APIModels\SendModels;


use TelegramBotLibrary\APIModels\BaseModels\SendBaseModel;

class SendMesssage extends SendBaseModel
{
    public $chat_id;
    public $text;
    public $parse_mode;
    public $disable_web_page_preview;
}