<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:14
 */

namespace TelegramBotLibrary\APIModels\SendTypes;

use TelegramBotLibrary\APIModels\BaseModels\SendFileBaseModel;

class SendAudio extends SendFileBaseModel
{
    const TYPE = 'audio';
    
    public $chat_id;
    public $audio;
    public $duration;
    public $performer;
    public $title;
}