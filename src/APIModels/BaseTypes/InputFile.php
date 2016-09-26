<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 23.09.2016
 * Time: 13:06
 */

namespace TelegramBotLibrary\APIModels\BaseTypes;

class InputFile extends \CURLFile
{
    public function toQuery ()
    {
        return $this;
    }
}