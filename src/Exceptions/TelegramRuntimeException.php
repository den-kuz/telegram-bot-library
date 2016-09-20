<?php

namespace TelegramBotLibrary\Exceptions;

class TelegramRuntimeException extends TelegramBotException
{

    /**
     * TelegramRuntimeException constructor.
     *
     * @param $message
     */
    public function __construct ( $message )
    {
        parent::__construct( $message );
    }
}