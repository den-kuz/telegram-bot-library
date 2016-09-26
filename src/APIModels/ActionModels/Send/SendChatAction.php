<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 26.09.2016
 * Time: 13:05
 */

namespace TelegramBotLibrary\APIModels\ActionModels\Send;

use TelegramBotLibrary\APIModels\BaseModels\SendModel;
use TelegramBotLibrary\APIModels\Constraints\ConstraintsConfiguration;
use TelegramBotLibrary\APIModels\Constraints\IsInteger;
use TelegramBotLibrary\APIModels\Constraints\IsString;
use TelegramBotLibrary\APIModels\Constraints\IsStringInEnum;
use TelegramBotLibrary\APIModels\Enums\ChatActions;

class SendChatAction extends SendModel
{
    /**
     * @var string|integer
     */
    protected $chat_id;

    /**
     * @var string
     */
    protected $action;

    protected function configure ()
    {
        $this
            ->addConstraintsConfiguration( 'chat_id', new ConstraintsConfiguration( [ new IsInteger() ], false ) )
            ->addConstraintsConfiguration( 'chat_id', new ConstraintsConfiguration( [ new IsString( true ) ], false ) )
            ->addConstraintsConfiguration( 'action', new ConstraintsConfiguration( [ new IsString( true ), new IsStringInEnum( ChatActions::getConstList() ) ], false ) );

        return $this;
    }

    protected function getProperties ()
    {
        return [
            'chat_id' => $this->getChatId(),
            'action'  => $this->getAction(),
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
     * @return SendChatAction
     */
    public function setChatId ( $chat_id )
    {
        $this->chat_id = $chat_id;

        return $this;
    }

    /**
     * @return string
     */
    public function getAction ()
    {
        return $this->action;
    }

    /**
     * @param string $action
     *
     * @return SendChatAction
     */
    public function setAction ( $action )
    {
        $this->action = $action;

        return $this;
    }
}