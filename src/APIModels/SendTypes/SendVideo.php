<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:26
 */

namespace TelegramBotLibrary\APIModels\SendTypes;


use TelegramBotLibrary\APIModels\BaseModels\SendFileBaseModel;

class SendVideo extends SendFileBaseModel
{
    public $chat_id;
    public $video;
    public $duration;
    public $width;
    public $height;
    public $caption;
}