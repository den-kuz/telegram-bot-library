<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:25
 */

namespace TelegramBotLibrary\APIModels\SendModels;


use TelegramBotLibrary\APIModels\BaseModels\BaseSendFileModel;

class SendFileSticker extends BaseSendFileModel
{
    const TYPE = 'sticker';
    
    public $chat_id;
    public $sticker;

    protected function configure ( $data )
    {
        // TODO: Implement configure() method.
    }
}