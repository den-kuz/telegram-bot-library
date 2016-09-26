<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 26.09.2016
 * Time: 16:00
 */

namespace TelegramBotLibrary\APIModels\ActionModels\Edit;

use TelegramBotLibrary\APIModels\BaseModels\SendModel;
use TelegramBotLibrary\APIModels\BaseTypes\Keyboard\InlineKeyboardMarkup;
use TelegramBotLibrary\APIModels\Constraints\ConstraintsConfiguration;
use TelegramBotLibrary\APIModels\Constraints\IsInteger;
use TelegramBotLibrary\APIModels\Constraints\IsObject;
use TelegramBotLibrary\APIModels\Constraints\IsString;
use TelegramBotLibrary\Exceptions\TelegramConstraintException;

class EditMessageReplyMarkup extends SendModel
{
    /**
     * @var integer | string
     */
    protected $chat_id;

    /**
     * @var integer
     */
    protected $message_id;

    /**
     * @var string
     */
    protected $inline_message_id;

    /**
     * @var InlineKeyboardMarkup
     */
    protected $reply_markup;

    protected function configure ()
    {
        $this
            ->addConstraintsConfiguration( 'chat_id', new ConstraintsConfiguration( [ new IsInteger() ], true ) )
            ->addConstraintsConfiguration( 'chat_id', new ConstraintsConfiguration( [ new IsString( true ) ], true ) )
            ->addConstraintsConfiguration( 'message_id', new ConstraintsConfiguration( [ new IsInteger() ], true ) )
            ->addConstraintsConfiguration( 'inline_message_id', new ConstraintsConfiguration( [ new IsString() ], true ) )
            ->addConstraintsConfiguration( 'reply_markup', new ConstraintsConfiguration( [ new IsObject( InlineKeyboardMarkup::class ) ], true ) );

        return $this;
    }

    protected function getProperties ()
    {
        return [
            'chat_id'                  => $this->getChatId(),
            'message_id'               => $this->getMessageId(),
            'inline_message_id'        => $this->getInlineMessageId(),
            'reply_markup'             => $this->getReplyMarkup(),
        ];
    }

    /**
     * @return int|string
     */
    public function getChatId ()
    {
        return $this->chat_id;
    }

    /**
     * @param int|string $chat_id
     *
     * @return EditMessageReplyMarkup
     */
    public function setChatId ( $chat_id )
    {
        $this->chat_id = $chat_id;

        return $this;
    }

    /**
     * @return int
     */
    public function getMessageId ()
    {
        return $this->message_id;
    }

    /**
     * @param int $message_id
     *
     * @return EditMessageReplyMarkup
     */
    public function setMessageId ( $message_id )
    {
        $this->message_id = $message_id;

        return $this;
    }

    /**
     * @return string
     */
    public function getInlineMessageId ()
    {
        return $this->inline_message_id;
    }

    /**
     * @param string $inline_message_id
     *
     * @return EditMessageReplyMarkup
     */
    public function setInlineMessageId ( $inline_message_id )
    {
        $this->inline_message_id = $inline_message_id;

        return $this;
    }

    /**
     * @return InlineKeyboardMarkup
     */
    public function getReplyMarkup ()
    {
        return $this->reply_markup;
    }

    /**
     * @param InlineKeyboardMarkup $reply_markup
     *
     * @return EditMessageReplyMarkup
     */
    public function setReplyMarkup ( InlineKeyboardMarkup $reply_markup )
    {
        $this->reply_markup = $reply_markup;

        return $this;
    }

    public function validateConstraints ()
    {
        if ( $this->inline_message_id && ( $this->message_id || $this->chat_id ) ) {
            throw new TelegramConstraintException( 'You must specify one of these sets of fields: [inline_message_id] or [message_id AND chat_id]' );
        }

        if ( $this->message_id && !$this->chat_id ) {
            throw new TelegramConstraintException( 'You must specify field "chat_id"' );
        }

        if ( !$this->message_id && $this->chat_id ) {
            throw new TelegramConstraintException( 'You must specify field "message_id"' );
        }

        parent::validateConstraints();
    }
}