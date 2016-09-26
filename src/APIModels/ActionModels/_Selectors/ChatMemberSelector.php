<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 26.09.2016
 * Time: 13:32
 */

namespace TelegramBotLibrary\APIModels\ActionModels\_Selectors;

use TelegramBotLibrary\APIModels\BaseModels\SendModel;
use TelegramBotLibrary\APIModels\Constraints\ConstraintsConfiguration;
use TelegramBotLibrary\APIModels\Constraints\IsInteger;
use TelegramBotLibrary\APIModels\Constraints\IsString;

class ChatMemberSelector extends SendModel
{
    /**
     * @var integer | string
     */
    protected $chat_id;

    /**
     * @var integer
     */
    protected $user_id;

    protected function configure ()
    {
        $this
            ->addConstraintsConfiguration( 'chat_id', new ConstraintsConfiguration( [ new IsInteger() ], false ) )
            ->addConstraintsConfiguration( 'chat_id', new ConstraintsConfiguration( [ new IsString( true ) ], false ) )
            ->addConstraintsConfiguration( 'user_id', new ConstraintsConfiguration( [ new IsInteger() ], false ) );

        return $this;
    }

    protected function getProperties ()
    {
        return [
            'chat_id' => $this->getChatId(),
            'user_id' => $this->getUserId(),
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
     * @return ChatMemberSelector
     */
    public function setChatId ( $chat_id )
    {
        $this->chat_id = $chat_id;

        return $this;
    }

    /**
     * @return int
     */
    public function getUserId ()
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     *
     * @return ChatMemberSelector
     */
    public function setUserId ( $user_id )
    {
        $this->user_id = $user_id;

        return $this;
    }
}