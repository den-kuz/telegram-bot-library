<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 19:50
 */

namespace TelegramBotLibrary\Exceptions;

class TelegramException extends \Exception
{
    public function __construct ( $message, $code = 0, \Exception $previous = null )
    {
        parent::__construct( $message, $code, $previous );
    }
}