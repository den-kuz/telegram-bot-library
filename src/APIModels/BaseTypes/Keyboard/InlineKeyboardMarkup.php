<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 19.07.2016
 * Time: 22:51
 */

namespace TelegramBotLibrary\APIModels\BaseTypes\Keyboard;

use TelegramBotLibrary\APIModels\BaseModels\SendModel;
use TelegramBotLibrary\APIModels\Constraints\ConstraintsConfiguration;
use TelegramBotLibrary\APIModels\Constraints\IsArrayOfArrayOfObjects;

class InlineKeyboardMarkup extends SendModel
{
    /**
     * @var InlineKeyboardButton[][]
     */
    protected $inline_keyboard;

    public function toQuery ()
    {
        return json_encode( parent::toQuery() );
    }

    protected function getProperties ()
    {
        return [
            'inline_keyboard' => $this->getInlineKeyboard(),
        ];
    }

    /**
     * @return InlineKeyboardButton[][]
     */
    public function getInlineKeyboard ()
    {
        return $this->inline_keyboard;
    }

    /**
     * @param InlineKeyboardButton[][] $inline_keyboard
     *
     * @return InlineKeyboardMarkup
     */
    public function setInlineKeyboard ( $inline_keyboard )
    {
        $this->inline_keyboard = $inline_keyboard;

        return $this;
    }

    protected function configure ()
    {
        $this
            ->addConstraintsConfiguration( 'inline_keyboard', new ConstraintsConfiguration( [ new IsArrayOfArrayOfObjects( InlineKeyboardButton::class ) ], false ) );

        return $this;
    }
}