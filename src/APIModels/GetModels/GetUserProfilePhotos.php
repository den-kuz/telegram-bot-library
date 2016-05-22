<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 21:28
 */

namespace TelegramBotLibrary\APIModels\GetModels;


use TelegramBotLibrary\APIModels\BaseModels\BaseModel;

class GetUserProfilePhotos extends BaseModel
{
    public $user_id;
    public $offset;
    public $limit;
}