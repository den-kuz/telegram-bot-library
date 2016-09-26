<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 19.09.2016
 * Time: 18:54
 */

namespace TelegramBotLibrary\APIModels\Enums;

use TelegramBotLibrary\APIModels\BaseModels\BaseEnum;

class SystemCreateTypes extends BaseEnum
{
    const Object = 'OBJECT';
    const ArrayOfObjects = 'ARRAY_OF_OBJECTS';
    const ArrayOfArrayOfObjects = 'ARRAY_OF_ARRAY_OF_OBJECTS';

    const Scalar = 'SCALAR';
    const ArrayOfScalar = 'ARRAY_OF_SCALAR';
    const ArrayOfArrayOfScalar = 'ARRAY_OF_ARRAY_OF_SCALAR';
}