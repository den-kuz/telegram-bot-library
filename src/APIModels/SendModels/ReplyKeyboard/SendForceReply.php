<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:19
 */

namespace TelegramBotLibrary\APIModels\SendModels\ReplyKeyboard;

use TelegramBotLibrary\APIModels\BaseModels\BaseSendModel;

class SendForceReply extends BaseSendModel
{
    public $force_reply = true;

    public $selective;

    public function toArray ()
    {
        return json_encode( parent::toArray() );
    }

    protected function configure ( $data )
    {
        // TODO: Implement configure() method.
    }
}