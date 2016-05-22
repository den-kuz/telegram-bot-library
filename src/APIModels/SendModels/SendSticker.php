<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:25
 */

namespace TelegramBotLibrary\APIModels\SendModels;


use TelegramBotLibrary\APIModels\BaseModels\SendFileBaseModel;

class SendSticker extends SendFileBaseModel
{
    const TYPE = 'sticker';
    
    public $chat_id;
    public $sticker;
}