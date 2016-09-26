<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 19.07.2016
 * Time: 22:53
 */

namespace TelegramBotLibrary\APIModels\BaseTypes\Keyboard;

use TelegramBotLibrary\APIModels\BaseModels\SendModel;
use TelegramBotLibrary\APIModels\Constraints\ConstraintsConfiguration;
use TelegramBotLibrary\APIModels\Constraints\IsString;
use TelegramBotLibrary\APIModels\Constraints\IsStringLengthBytes;
use TelegramBotLibrary\Exceptions\TelegramRuntimeException;

class InlineKeyboardButton extends SendModel
{
    /**
     * @var string
     */
    protected $text;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $callback_data;

    /**
     * @var string
     */
    protected $switch_inline_query;

    protected function getProperties ()
    {
        return [
            'text'                => $this->getText(),
            'url'                 => $this->getUrl(),
            'callback_data'       => $this->getCallbackData(),
            'switch_inline_query' => $this->getSwitchInlineQuery(),
        ];
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
     * @return InlineKeyboardButton
     */
    public function setText ( $text )
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl ()
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return InlineKeyboardButton
     */
    public function setUrl ( $url )
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getCallbackData ()
    {
        return $this->callback_data;
    }

    /**
     * @param string $callback_data
     *
     * @return InlineKeyboardButton
     */
    public function setCallbackData ( $callback_data )
    {
        $this->callback_data = $callback_data;

        return $this;
    }

    /**
     * @return string
     */
    public function getSwitchInlineQuery ()
    {
        return $this->switch_inline_query;
    }

    /**
     * @param string $switch_inline_query
     *
     * @return InlineKeyboardButton
     */
    public function setSwitchInlineQuery ( $switch_inline_query )
    {
        $this->switch_inline_query = $switch_inline_query;

        return $this;
    }

    protected function configure ()
    {
        $this
            ->addConstraintsConfiguration( 'text', new ConstraintsConfiguration( [ new IsString() ], false ) )
            ->addConstraintsConfiguration( 'url', new ConstraintsConfiguration( [ new IsString() ], true ) )
            ->addConstraintsConfiguration( 'callback_data', new ConstraintsConfiguration( [ new IsStringLengthBytes( 1, 64 ) ], true ) )
            ->addConstraintsConfiguration( 'switch_inline_query', new ConstraintsConfiguration( [ new IsString() ], true ) );

        return $this;
    }

    public function validateConstraints ()
    {
        if (
            ( !empty( $this->url ) && ( !empty( $this->callback_data ) || !empty( $this->switch_inline_query ) ) ) ||
            ( !empty( $this->callback_data ) && ( !empty( $this->url ) || !empty( $this->switch_inline_query ) ) ) ||
            ( !empty( $this->switch_inline_query ) && ( !empty( $this->url ) || !empty( $this->callback_data ) ) )
        ) {
            throw new TelegramRuntimeException( 'You must use exactly one of the fields: url, callback_data or switch_inline_query' );
        }

        parent::validateConstraints();
    }
}