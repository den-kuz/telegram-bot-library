<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:23
 */

namespace TelegramBotLibrary\APIModels\SendModels;

use TelegramBotLibrary\APIModels\BaseModels\BaseSendModel;

class LocationSend extends BaseSendModel
{
    public $chat_id;
    public $latitude;
    public $longitude;

    protected function configure ( $data )
    {
        // TODO: Implement configure() method.
    }
}