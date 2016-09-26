<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 23.09.2016
 * Time: 4:42
 */

namespace TelegramBotLibrary\APIModels\ActionModels\Send;

use TelegramBotLibrary\APIModels\BaseModels\SendModel;
use TelegramBotLibrary\APIModels\BaseTypes\Keyboard\ForceReply;
use TelegramBotLibrary\APIModels\BaseTypes\Keyboard\InlineKeyboardMarkup;
use TelegramBotLibrary\APIModels\BaseTypes\Keyboard\ReplyKeyboardHide;
use TelegramBotLibrary\APIModels\BaseTypes\Keyboard\ReplyKeyboardMarkup;
use TelegramBotLibrary\APIModels\Constraints\ConstraintsConfiguration;
use TelegramBotLibrary\APIModels\Constraints\IsBoolean;
use TelegramBotLibrary\APIModels\Constraints\IsInteger;
use TelegramBotLibrary\APIModels\Constraints\IsObject;

abstract class _GeneralSendModel extends SendModel
{
    /**
     * @var boolean
     */
    protected $disable_notification;

    /**
     * @var integer
     */
    protected $reply_to_message_id;

    /**
     * @var InlineKeyboardMarkup | ReplyKeyboardMarkup | ReplyKeyboardHide | ForceReply
     */
    protected $reply_markup;

    protected function getProperties ()
    {
        return [
            'disable_notification' => $this->getDisableNotification(),
            'reply_to_message_id'  => $this->getReplyToMessageId(),
            'reply_markup'         => $this->getReplyMarkup(),
        ];
    }

    /**
     * @return boolean
     */
    public function getDisableNotification ()
    {
        return $this->disable_notification;
    }

    /**
     * @param boolean $disable_notification
     *
     * @return _GeneralSendModel
     */
    public function setDisableNotification ( $disable_notification )
    {
        $this->disable_notification = $disable_notification;

        return $this;
    }

    /**
     * @return int
     */
    public function getReplyToMessageId ()
    {
        return $this->reply_to_message_id;
    }

    /**
     * @param int $reply_to_message_id
     *
     * @return _GeneralSendModel
     */
    public function setReplyToMessageId ( $reply_to_message_id )
    {
        $this->reply_to_message_id = $reply_to_message_id;

        return $this;
    }

    /**
     * @return InlineKeyboardMarkup|ForceReply|ReplyKeyboardHide|ReplyKeyboardMarkup
     */
    public function getReplyMarkup ()
    {
        return $this->reply_markup;
    }

    /**
     * @param InlineKeyboardMarkup|ForceReply|ReplyKeyboardHide|ReplyKeyboardMarkup $reply_markup
     *
     * @return _GeneralSendModel
     */
    public function setReplyMarkup ( $reply_markup )
    {
        $this->reply_markup = $reply_markup;

        return $this;
    }

    protected function configure ()
    {
        $this
            ->addConstraintsConfiguration( 'disable_notification', new ConstraintsConfiguration( [ new IsBoolean() ], true ) )
            ->addConstraintsConfiguration( 'reply_to_message_id', new ConstraintsConfiguration( [ new IsInteger() ], true ) )
            ->addConstraintsConfiguration( 'reply_markup', new ConstraintsConfiguration( [ new IsObject( InlineKeyboardMarkup::class ) ], true ) )
            ->addConstraintsConfiguration( 'reply_markup', new ConstraintsConfiguration( [ new IsObject( ReplyKeyboardMarkup::class ) ], true ) )
            ->addConstraintsConfiguration( 'reply_markup', new ConstraintsConfiguration( [ new IsObject( ReplyKeyboardHide::class ) ], true ) )
            ->addConstraintsConfiguration( 'reply_markup', new ConstraintsConfiguration( [ new IsObject( ForceReply::class ) ], true ) );

        return $this;
    }
}