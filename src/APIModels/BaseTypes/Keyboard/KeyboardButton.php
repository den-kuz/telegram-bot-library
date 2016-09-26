<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:22
 */

namespace TelegramBotLibrary\APIModels\BaseTypes\Keyboard;

use TelegramBotLibrary\APIModels\BaseModels\SendModel;
use TelegramBotLibrary\APIModels\Constraints\ConstraintsConfiguration;
use TelegramBotLibrary\APIModels\Constraints\IsBoolean;
use TelegramBotLibrary\APIModels\Constraints\IsString;

class KeyboardButton extends SendModel
{
    /**
     * @var string
     */
    protected $text;

    /**
     * @var boolean
     */
    protected $request_contact;

    /**
     * @var boolean
     */
    protected $request_location;

    protected function configure ()
    {
        $this
            ->addConstraintsConfiguration( 'text', new ConstraintsConfiguration( [ new IsString() ], false ) )
            ->addConstraintsConfiguration( 'request_contact', new ConstraintsConfiguration( [ new IsBoolean() ], true ) )
            ->addConstraintsConfiguration( 'request_location', new ConstraintsConfiguration( [ new IsBoolean() ], true ) );

        return $this;
    }

    protected function getProperties ()
    {
        return [
            'text'             => $this->getText(),
            'request_contact'  => $this->getRequestContact(),
            'request_location' => $this->getRequestLocation(),
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
     * @return KeyboardButton
     */
    public function setText ( $text )
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getRequestContact ()
    {
        return $this->request_contact;
    }

    /**
     * @param boolean $request_contact
     *
     * @return KeyboardButton
     */
    public function setRequestContact ( $request_contact )
    {
        $this->request_contact = $request_contact;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getRequestLocation ()
    {
        return $this->request_location;
    }

    /**
     * @param boolean $request_location
     *
     * @return KeyboardButton
     */
    public function setRequestLocation ( $request_location )
    {
        $this->request_location = $request_location;

        return $this;
    }
}