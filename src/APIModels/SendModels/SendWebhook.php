<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 07.07.2016
 * Time: 23:34
 */

namespace TelegramBotLibrary\APIModels\SendModels;


use TelegramBotLibrary\APIModels\BaseModels\SendFileBaseModel;

class SendWebhook extends SendFileBaseModel
{
    const TYPE = 'certificate';

    public $url;
    public $certificate;
}