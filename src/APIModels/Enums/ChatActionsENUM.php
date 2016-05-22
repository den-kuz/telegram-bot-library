<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 23:10
 */

namespace TelegramBotLibrary\APIModels\Enums;


use TelegramBotLibrary\APIModels\BaseModels\BaseEnum;

class ChatActionsENUM extends BaseEnum
{
    const TYPING = 'typing';
    const UPLOAD_PHOTO = 'upload_photo';
    const RECORD_VIDEO = 'record_video';
    const UPLOAD_VIDEO = 'upload_video';
    const RECORD_AUDIO = 'record_audio';
    const UPLOAD_AUDIO = 'upload_audio';
    const UPLOAD_DOCUMENT = 'upload_document';
    const FIND_LOCATION = 'find_location';
}