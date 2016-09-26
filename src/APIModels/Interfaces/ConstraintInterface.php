<?php

namespace TelegramBotLibrary\APIModels\Interfaces;

interface ConstraintInterface
{
    public function isValid ( $dataValue );

    public function getDescription ();
}