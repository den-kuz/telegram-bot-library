<?php

namespace TelegramBotLibrary\APIModels\BaseTypes\Keyboard;

use TelegramBotLibrary\APIModels\BaseModels\SendModel;
use TelegramBotLibrary\APIModels\Constraints\ConstraintsConfiguration;
use TelegramBotLibrary\APIModels\Constraints\IsBoolean;

class ReplyKeyboardHide extends SendModel
{
    /**
     * @var boolean
     */
    protected $hide_keyboard = true;

    /**
     * @var boolean
     */
    protected $selective;

    protected function configure ()
    {
        $this
            ->addConstraintsConfiguration( 'hide_keyboard', new ConstraintsConfiguration( [ new IsBoolean() ], false ) )
            ->addConstraintsConfiguration( 'selective', new ConstraintsConfiguration( [ new IsBoolean() ], true ) );

        return $this;
    }

    protected function getProperties ()
    {
        return [
            'hide_keyboard' => $this->getHideKeyboard(),
            'selective'     => $this->getSelective(),
        ];
    }

    /**
     * @return boolean
     */
    public function getHideKeyboard ()
    {
        return $this->hide_keyboard;
    }

    /**
     * @return boolean
     */
    public function getSelective ()
    {
        return $this->selective;
    }

    /**
     * @param boolean $selective
     *
     * @return ReplyKeyboardHide
     */
    public function setSelective ( $selective )
    {
        $this->selective = (boolean)$selective;

        return $this;
    }

    public function toQuery ( $keepNulls = false )
    {
        return json_encode( parent::toQuery( $keepNulls ) );
    }
}