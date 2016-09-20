<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:26
 */

namespace TelegramBotLibrary\APIModels\SendModels;


use TelegramBotLibrary\APIModels\BaseModels\BaseSendFileModel;

class SendFileVideo extends BaseSendFileModel
{
    const TYPE = 'video';
    
    public $chat_id;
    public $video;
    public $duration;
    public $width;
    public $height;
    public $caption;

    protected function configure ( $data )
    {
        // TODO: Implement configure() method.
    }
}