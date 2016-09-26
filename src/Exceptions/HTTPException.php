<?php

namespace TelegramBotLibrary\Exceptions;

class HTTPException extends TelegramException
{

    /**
     * HTTPException constructor.
     *
     * @param integer $code
     * @param string $message
     */
    public function __construct ( $message = '', $code )
    {
        parent::__construct( $message, $code );
    }
}