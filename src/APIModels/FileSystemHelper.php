<?php

namespace TelegramBotLibrary\APIModels;

use TelegramBotLibrary\APIModels\BaseTypes\InputFile;
use TelegramBotLibrary\Exceptions\TelegramRuntimeException;

trait FileSystemHelper
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

    public static function saveContent ( $content, $saveDir = './', $saveFilename = null, $saveFileExtension = null )
    {
        $saveDir = realpath( $saveDir );

        if ( !is_dir( $saveDir ) ) @mkdir( $saveDir, true );
        if ( !is_dir( $saveDir ) || !is_writeable( $saveDir ) )
            throw new TelegramRuntimeException( 'Directory "' . $saveDir . '"  path is not writable' );

        $fullFilePath = $saveDir . DIRECTORY_SEPARATOR;

        $fullFilePath .= !is_null( $saveFilename ) ? $saveFilename : md5( md5( $content ) . md5( microtime() ) );
        $fullFilePath .= !is_null( $saveFileExtension ) ? '.' . $saveFileExtension : '';

        $fullFilePath = realpath( $fullFilePath );
        $writeResult = file_put_contents( $fullFilePath, $content );
        if ( $writeResult ) {
            throw new TelegramRuntimeException( 'Can not write in file "' . $fullFilePath . '"' );
        }

        return $fullFilePath;
    }
}