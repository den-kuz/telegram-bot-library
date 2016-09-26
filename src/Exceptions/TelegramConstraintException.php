<?php

namespace TelegramBotLibrary\Exceptions;

class TelegramConstraintException extends TelegramException
{

    /**
     * TelegramConstraintException constructor.
     *
     * @param string $message
     */
    public function __construct ( $message = '' )
    {
        parent::__construct( $message );
    }
}