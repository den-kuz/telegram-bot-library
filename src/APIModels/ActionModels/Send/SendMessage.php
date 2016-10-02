<?php

namespace TelegramBotLibrary\APIModels\ActionModels\Send;

use TelegramBotLibrary\APIModels\Constraints\ConstraintsConfiguration;
use TelegramBotLibrary\APIModels\Constraints\IsBoolean;
use TelegramBotLibrary\APIModels\Constraints\IsInteger;
use TelegramBotLibrary\APIModels\Constraints\IsString;

class SendMessage extends _GeneralSendModel
{
    /**
     * @var integer | string
     */
    protected $chat_id;

    /**
     * @var string
     */
    protected $text;

    /**
     * @var string
     */
    protected $parse_mode;

    /**
     * @var boolean
     */
    protected $disable_web_page_preview;

    /**
     * @return boolean
     */
    public function isDisableWebPagePreview ()
    {
        return $this->disable_web_page_preview;
    }

    /**
     * @param boolean $disable_web_page_preview
     *
     * @return SendMessage
     */
    public function setDisableWebPagePreview ( $disable_web_page_preview )
    {
        $this->disable_web_page_preview = $disable_web_page_preview;

        return $this;
    }

    protected function getProperties ()
    {
        return array_merge(
            [
                'chat_id'                  => $this->getChatId(),
                'text'                     => $this->getText(),
                'parse_mode'               => $this->getParseMode(),
                'disable_web_page_preview' => $this->getDisableNotification(),
            ],
            parent::getProperties()
        );
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
     * @return SendMessage
     */
    public function setChatId ( $chat_id )
    {
        $this->chat_id = $chat_id;

        return $this;
    }

    /**
     * @return string
     */
    public function getText ()
    {
        return $this->text;
    }

    /**
     * @param string $text
     *
     * @return SendMessage
     */
    public function setText ( $text )
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return string
     */
    public function getParseMode ()
    {
        return $this->parse_mode;
    }

    /**
     * @param string $parse_mode
     *
     * @return SendMessage
     */
    public function setParseMode ( $parse_mode )
    {
        $this->parse_mode = $parse_mode;

        return $this;
    }

    protected function configure ()
    {
        $this
            ->addConstraintsConfiguration( 'chat_id', new ConstraintsConfiguration( [ new IsInteger() ], false ) )
            ->addConstraintsConfiguration( 'chat_id', new ConstraintsConfiguration( [ new IsString( true ) ], false ) )
            ->addConstraintsConfiguration( 'text', new ConstraintsConfiguration( [ new IsString() ], false ) )
            ->addConstraintsConfiguration( 'parse_mode', new ConstraintsConfiguration( [ new IsString( true ) ], true ) )
            ->addConstraintsConfiguration( 'disable_web_page_preview', new ConstraintsConfiguration( [ new IsBoolean() ], true ) );

        parent::configure();

        return $this;
    }
}