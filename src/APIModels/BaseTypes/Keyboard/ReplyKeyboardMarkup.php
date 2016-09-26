<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:25
 */

namespace TelegramBotLibrary\APIModels\BaseTypes\Keyboard;

use TelegramBotLibrary\APIModels\BaseModels\SendModel;
use TelegramBotLibrary\APIModels\Constraints\ConstraintsConfiguration;
use TelegramBotLibrary\APIModels\Constraints\IsArrayOfArrayOfObjects;
use TelegramBotLibrary\APIModels\Constraints\IsArrayOfArrayOfStrings;
use TelegramBotLibrary\APIModels\Constraints\IsArrayOfObjects;
use TelegramBotLibrary\APIModels\Constraints\IsArrayOfStrings;
use TelegramBotLibrary\APIModels\Constraints\IsBoolean;
use TelegramBotLibrary\Exceptions\TelegramRuntimeException;

class ReplyKeyboardMarkup extends SendModel
{
    /**
     * @var KeyboardButton[][] | string[][]
     */
    protected $keyboard;

    /**
     * @var boolean
     */
    protected $resize_keyboard;

    /**
     * @var boolean
     */
    protected $one_time_keyboard;

    /**
     * @var boolean
     */
    protected $selective;

    /**
     * @param string[] | KeyboardButton[] $row
     *
     * @return ReplyKeyboardMarkup
     * @throws TelegramRuntimeException
     */
    public function addKeyBoardRow ( $row )
    {
        $isArrayOfButtons = new IsArrayOfObjects( KeyboardButton::class );
        $isArrayOfStrings = new IsArrayOfStrings();

        if ( $isArrayOfButtons->isValid( $row ) ) {
            $this->keyboard[] = $row;
        } elseif ( $isArrayOfStrings->isValid( $row ) ) {
            $this->keyboard[] = $row;
        } else {
            throw new TelegramRuntimeException( 'Value must be in type: ' . $isArrayOfButtons->getDescription() . ' or ' . $isArrayOfStrings->getDescription() );
        }

        return $this;
    }

    public function toQuery ( $keepNulls = false )
    {
        return json_encode( parent::toQuery( $keepNulls ) );
    }

    protected function getProperties ()
    {
        return [
            'keyboard'          => $this->getKeyboard(),
            'resize_keyboard'   => $this->getResizeKeyboard(),
            'one_time_keyboard' => $this->getOneTimeKeyboard(),
            'selective'         => $this->getSelective(),
        ];
    }

    /**
     * @return KeyboardButton[][] | string[][]
     */
    public function getKeyboard ()
    {
        return $this->keyboard;
    }

    /**
     * @param KeyboardButton[][] | string[][] $keyboard
     *
     * @return $this
     * @throws TelegramRuntimeException
     */
    public function setKeyboard ( $keyboard )
    {
        $this->keyboard = $keyboard;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getResizeKeyboard ()
    {
        return $this->resize_keyboard;
    }

    /**
     * @param boolean $resize_keyboard
     *
     * @return $this
     */
    public function setResizeKeyboard ( $resize_keyboard )
    {
        $this->resize_keyboard = $resize_keyboard;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getOneTimeKeyboard ()
    {
        return $this->one_time_keyboard;
    }

    /**
     * @param boolean $one_time_keyboard
     *
     * @return $this
     */
    public function setOneTimeKeyboard ( $one_time_keyboard )
    {
        $this->one_time_keyboard = $one_time_keyboard;

        return $this;
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
     * @return $this
     */
    public function setSelective ( $selective )
    {
        $this->selective = $selective;

        return $this;
    }

    protected function configure ()
    {
        $this
            ->addConstraintsConfiguration( 'keyboard', new ConstraintsConfiguration( [ new IsArrayOfArrayOfObjects( KeyboardButton::class ) ], false ) )
            ->addConstraintsConfiguration( 'keyboard', new ConstraintsConfiguration( [ new IsArrayOfArrayOfStrings() ], false ) )
            ->addConstraintsConfiguration( 'resize_keyboard', new ConstraintsConfiguration( [ new IsBoolean() ], true ) )
            ->addConstraintsConfiguration( 'one_time_keyboard', new ConstraintsConfiguration( [ new IsBoolean() ], true ) )
            ->addConstraintsConfiguration( 'selective', new ConstraintsConfiguration( [ new IsBoolean() ], true ) );

        return $this;
    }
}