<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 07.07.2016
 * Time: 23:34
 */

namespace TelegramBotLibrary\APIModels\SendModels;


use TelegramBotLibrary\APIModels\BaseModels\BaseSendFileModel;

class SendFileWebhook extends BaseSendFileModel
{
    const TYPE = 'certificate';

    public $url;
    public $certificate;

    protected function configure ( $data )
    {
        // TODO: Implement configure() method.
    }
}