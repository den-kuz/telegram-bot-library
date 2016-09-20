<?php

namespace TelegramBotLibrary\APIModels\SendModels;

use TelegramBotLibrary\APIModels\BaseModels\BaseSendFileModel;

class SendSticker extends BaseSendFileModel
{
    const TYPE = 'sticker';
    
    public $chat_id;
    public $sticker;

    protected function configure ( $data )
    {
        // TODO: Implement configure() method.
    }
}