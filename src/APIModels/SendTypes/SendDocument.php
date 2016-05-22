<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:18
 */

namespace TelegramBotLibrary\APIModels\SendTypes;


use TelegramBotLibrary\APIModels\BaseModels\SendFileBaseModel;

class SendDocument extends SendFileBaseModel
{
    const TYPE = 'document';

    public $chat_id;
    public $document;
    public $caption;
}