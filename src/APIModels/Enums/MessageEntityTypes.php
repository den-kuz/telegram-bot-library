<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 21:13
 */

namespace TelegramBotLibrary\APIModels\Enums;

use TelegramBotLibrary\APIModels\BaseModels\BaseEnum;

class MessageEntityTypes extends BaseEnum
{
    const MENTION = 'mention';
    const HASHTAG = 'hashtag';
    const BOT_COMMAND = 'bot_command';
    const URL = 'url';
    const EMAIL = 'email';
    const BOLD = 'bold';
    const ITALIC = 'italic';
    const CODE = 'code';
    const PRE = 'code';
    const TEXT_LINK = 'text_link';
    const TEXT_MENTION = 'text_mention';
}