<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:18
 */

namespace TelegramBotLibrary\APIModels\SendModels;


use TelegramBotLibrary\APIModels\BaseModels\BaseSendFileModel;

class SendFileDocument extends BaseSendFileModel
{
    const TYPE = 'document';

    public $chat_id;
    public $document;
    public $caption;

    protected function configure ( $data )
    {
        // TODO: Implement configure() method.
    }
}