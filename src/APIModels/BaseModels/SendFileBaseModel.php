<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:14
 */

namespace TelegramBotLibrary\APIModels\BaseModels;


use TelegramBotLibrary\Exceptions\TelegramBotException;

abstract class SendFileBaseModel extends SendBaseModel
{
    const TYPE = 'document';
    
    public function setFileByPath($path) {
        $type = static::TYPE;
        $this->$type = new \CURLFile(realpath($path), '', basename(realpath($path)));
    }

    public function setFileById($id) {
        $type = static::TYPE;
        $this->$type = $id;
    }

    public function setFileByResource($resource, $file_extension, $savepath = '.') {
        $type = static::TYPE;
        
        $savepath = realpath($savepath);
        if( !is_dir($savepath) ) throw new TelegramBotException('Неверная папка для сохранения');

        if( gettype($resource) !== 'resource' ) {
            $filename = $savepath . '/' . md5 ( md5($resource) . md5(microtime()) ) . '.' . $file_extension;
            file_put_contents($filename, $resource);
            
            $this->$type = new \CURLFile($filename);
        } else {
            throw new TelegramBotException('Неверный тип переменной $PhotoResource');
        }
    }
}