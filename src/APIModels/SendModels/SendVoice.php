<?php

namespace TelegramBotLibrary\APIModels\SendModels;

use TelegramBotLibrary\APIModels\BaseModels\BaseSendFileModel;

class SendVoice extends BaseSendFileModel
{
    const TYPE = 'voice';

    public $chat_id;
    public $voice;
    public $duration;

    protected function configure ( $data )
    {
        // TODO: Implement configure() method.
    }
}