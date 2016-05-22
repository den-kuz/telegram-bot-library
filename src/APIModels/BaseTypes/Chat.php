<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 19:59
 */

namespace TelegramBotLibrary\APIModels\BaseTypes;

use TelegramBotLibrary\APIModels\BaseModels\BaseModel;

class Chat extends BaseModel
{
    public $id;
    public $type;
    public $title;
    public $username;
    public $first_name;
    public $last_name;
}