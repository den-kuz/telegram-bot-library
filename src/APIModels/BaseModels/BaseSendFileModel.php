<?php

namespace TelegramBotLibrary\APIModels\BaseModels;

use CURLFile;
use TelegramBotLibrary\Exceptions\TelegramRuntimeException;

abstract class BaseSendFileModel extends BaseSendModel
{
    const TYPE = 'document';

    public function setFileByPath ( $path, $mime = '' )
    {
        $type = static::TYPE;
        $path = realpath( $path );
        $this->{$type} = new CURLFile( $path, $mime, basename( $path ) );

        return $this;
    }

    public function setFileById ( $id )
    {
        $type = static::TYPE;
        $this->{$type} = $id;
    }

    public function setFileByContent ( $content, $savepath = '.', $file_extension = '', &$saved_file )
    {
        $type = static::TYPE;
        $savepath = realpath( $savepath );

        @mkdir( $savepath, true );
        if ( !is_dir( $savepath ) || !is_writeable( $savepath ) )
            throw new TelegramRuntimeException( 'Save path is not writable' );

        $filename = $savepath . '/' . md5( md5( $content ) . md5( microtime() ) );
        if ( !empty( $file_extension ) || $file_extension === '0' ) {
            $filename = $filename . '.' . $file_extension;
        }

        file_put_contents( $filename, $content );

        $saved_file = $filename;
        $this->{$type} = new CURLFile( $filename );

        return $this;
    }
}