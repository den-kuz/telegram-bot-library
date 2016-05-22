<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:06
 */

namespace TelegramBotLibrary\APIModels\BaseTypes;

use TelegramBotLibrary\APIModels\BaseModels\BaseModel;

class Voice extends BaseModel
{
    public $file_id;
    public $duration;
    public $mime_type;
    public $file_size;
}