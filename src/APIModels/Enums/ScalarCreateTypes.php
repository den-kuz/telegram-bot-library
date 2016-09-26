<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 25.09.2016
 * Time: 4:10
 */

namespace TelegramBotLibrary\APIModels\Enums;


use TelegramBotLibrary\APIModels\BaseModels\BaseEnum;

class ScalarCreateTypes extends BaseEnum
{
    const INTEGER = 'integer';
    const FLOAT = 'float';
    const BOOLEAN = 'boolean';
    const STRING = 'string';
    const OBJECT = 'object';
    const ARRAY = 'array';
}