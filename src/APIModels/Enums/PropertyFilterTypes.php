<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 21.09.2016
 * Time: 16:58
 */

namespace TelegramBotLibrary\APIModels\Enums;

use ReflectionProperty;
use TelegramBotLibrary\APIModels\BaseModels\BaseEnum;

class PropertyFilterTypes extends BaseEnum
{
    const PUBLIC = ReflectionProperty::IS_PUBLIC;
    const PROTECTED = ReflectionProperty::IS_PROTECTED;
    const PRIVATE = ReflectionProperty::IS_PRIVATE;
    const STATIC = ReflectionProperty::IS_STATIC;
}