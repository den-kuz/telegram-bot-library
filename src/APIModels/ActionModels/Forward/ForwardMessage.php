<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:20
 */

namespace TelegramBotLibrary\APIModels\ActionModels\Forward;

use TelegramBotLibrary\APIModels\BaseModels\SendModel;
use TelegramBotLibrary\APIModels\Constraints\ConstraintsConfiguration;
use TelegramBotLibrary\APIModels\Constraints\IsBoolean;
use TelegramBotLibrary\APIModels\Constraints\IsInteger;
use TelegramBotLibrary\APIModels\Constraints\IsString;

class ForwardMessage extends SendModel
{
    /**
     * @var integer | string
     */
    protected $chat_id;

    /**
     * @var integer | string
     */
    protected $from_chat_id;

    /**
     * @var boolean
     */
    protected $disable_notification;

    /**
     * @var integer
     */
    protected $message_id;

    protected function getProperties ()
    {
        return [
            'chat_id'              => $this->getChatId(),
            'from_chat_id'         => $this->getFromChatId(),
            'disable_notification' => $this->getDisableNotification(),
            'message_id'           => $this->getMessageId(),
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
     * @return ForwardMessage
     */
    public function setChatId ( $chat_id )
    {
        $this->chat_id = $chat_id;

        return $this;
    }

    /**
     * @return int|string
     */
    public function getFromChatId ()
    {
        return $this->from_chat_id;
    }

    /**
     * @param int|string $from_chat_id
     *
     * @return ForwardMessage
     */
    public function setFromChatId ( $from_chat_id )
    {
        $this->from_chat_id = $from_chat_id;

        return $this;
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
     * @return ForwardMessage
     */
    public function setDisableNotification ( $disable_notification )
    {
        $this->disable_notification = $disable_notification;

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
     * @return ForwardMessage
     */
    public function setMessageId ( $message_id )
    {
        $this->message_id = $message_id;

        return $this;
    }

    protected function configure ()
    {
        $this
            ->addConstraintsConfiguration( 'chat_id', new ConstraintsConfiguration( [ new IsInteger() ], false ) )
            ->addConstraintsConfiguration( 'chat_id', new ConstraintsConfiguration( [ new IsString( true ) ], false ) )
            ->addConstraintsConfiguration( 'from_chat_id', new ConstraintsConfiguration( [ new IsInteger() ], false ) )
            ->addConstraintsConfiguration( 'from_chat_id', new ConstraintsConfiguration( [ new IsString( true ) ], false ) )
            ->addConstraintsConfiguration( 'message_id', new ConstraintsConfiguration( [ new IsInteger() ], false ) )
            ->addConstraintsConfiguration( 'disable_notification', new ConstraintsConfiguration( [ new IsBoolean() ], true ) );

        return $this;
    }
}