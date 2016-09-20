<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 21:04
 */

namespace TelegramBotLibrary\APIModels\Enums;


use TelegramBotLibrary\APIModels\BaseModels\BaseEnum;

class ChatTypes extends BaseEnum
{
    const TYPE_PRIVATE = 'private';
    const TYPE_GROUP = 'group';
    const TYPE_SUPERGROUP = 'supergroup';
    const TYPE_CHANNEL = 'channel';
}