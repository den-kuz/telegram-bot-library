<?php

namespace TelegramBotLibrary\Exceptions;

class HttpException extends TelegramBotException {

    /**
     * HttpException constructor.
     * @param integer $code
     * @param string $message
     */
    public function __construct( $code, $message = '' )
    {
        parent::__construct($message, $code);
    }

}
