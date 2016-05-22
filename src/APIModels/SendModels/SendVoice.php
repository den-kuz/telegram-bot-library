<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:27
 */

namespace TelegramBotLibrary\APIModels\SendModels;


use TelegramBotLibrary\APIModels\BaseModels\SendFileBaseModel;

class SendVoice extends SendFileBaseModel
{
    const TYPE = 'voice';

    public $chat_id;
    public $voice;
    public $duration;
}