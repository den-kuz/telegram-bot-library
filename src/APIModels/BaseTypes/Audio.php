<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 19:59
 */

namespace TelegramBotLibrary\APIModels\BaseTypes;


use TelegramBotLibrary\APIModels\BaseModels\BaseModel;

class Audio extends BaseModel
{
    public $file_id;
    public $duration;
    public $performer;
    public $title;
    public $mime_type;
    public $file_size;
}