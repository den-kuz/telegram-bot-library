<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 27.09.2016
 * Time: 16:14
 */

namespace TelegramBotLibrary;

use TelegramBotLibrary\Exceptions\TelegramException;

trait FileSystemHelper
{
    public static function saveContent ( $content, $saveDir = __DIR__, $saveFilename = null, $saveFileExtension = null )
    {
        if ( !is_dir( $saveDir ) ) @mkdir( $saveDir, true );
        if ( !is_dir( $saveDir ) || !is_writeable( $saveDir ) )
            throw new TelegramException( 'Directory "' . $saveDir . '"  path is not writable' );

        $fullFilePath = $saveDir . DIRECTORY_SEPARATOR;

        $fullFilePath .= !is_null( $saveFilename ) ? $saveFilename : md5( md5( $content ) . md5( microtime() ) );
        $fullFilePath .= !is_null( $saveFileExtension ) ? '.' . $saveFileExtension : '';

        $writeResult = file_put_contents( $fullFilePath, $content );
        if ( $writeResult === false ) {
            throw new TelegramException( 'Can not write in file "' . $fullFilePath . '"' );
        }

        return realpath( $fullFilePath );
    }
}