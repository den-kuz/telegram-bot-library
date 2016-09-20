<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:14
 */

namespace TelegramBotLibrary\APIModels\SendModels;

use TelegramBotLibrary\APIModels\BaseModels\BaseSendFileModel;

class SendAudio extends BaseSendFileModel
{
    const TYPE = 'audio';
    
    public $chat_id;
    public $audio;
    public $duration;
    public $performer;
    public $title;

    protected function configure ( $data )
    {
        // TODO: Implement configure() method.
    }
}