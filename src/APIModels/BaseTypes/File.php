<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 23:35
 */

namespace TelegramBotLibrary\APIModels\BaseTypes;


use TelegramBotLibrary\APIModels\BaseModels\BaseModel;

class File extends BaseModel
{
    public $file_id;
    public $file_size;
    public $file_path;
}