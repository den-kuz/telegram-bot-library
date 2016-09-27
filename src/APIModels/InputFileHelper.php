<?php

namespace TelegramBotLibrary\APIModels;

use TelegramBotLibrary\APIModels\BaseTypes\InputFile;
use TelegramBotLibrary\Exceptions\TelegramRuntimeException;

trait InputFileHelper
{
    public static function inputFileByPath ( $path, $mime = null, $postname = null )
    {
        $path = realpath( $path );

        if ( !is_file( $path ) || !is_readable( $path ) ) {
            throw new TelegramRuntimeException( 'There is no readable file: ' . $path );
        }

        return new InputFile( $path, $mime, $postname ? $postname : basename( $path ) );
    }

    public static function inputFileByFileId ( $id )
    {
        return (string)$id;
    }
}