<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:24
 */

namespace TelegramBotLibrary\APIModels\SendModels;

use TelegramBotLibrary\APIModels\BaseModels\BaseSendFileModel;

class SendFilePhoto extends BaseSendFileModel
{
    const TYPE = 'photo'; 
    
    public $chat_id;
    public $photo;
    public $caption;

    protected function configure ( $data )
    {
        // TODO: Implement configure() method.
    }
}