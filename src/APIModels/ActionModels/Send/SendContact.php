<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:18
 */

namespace TelegramBotLibrary\APIModels\ActionModels\Send;

use TelegramBotLibrary\APIModels\Constraints\ConstraintsConfiguration;
use TelegramBotLibrary\APIModels\Constraints\IsInteger;
use TelegramBotLibrary\APIModels\Constraints\IsString;

class SendContact extends _GeneralSendModel
{
    /**
     * @var integer | string
     */
    protected $chat_id;

    /**
     * @var string
     */
    protected $phone_number;

    /**
     * @var string
     */
    protected $first_name;

    /**
     * @var string
     */
    protected $last_name;

    protected function getProperties ()
    {
        return array_merge(
            [
                'chat_id'      => $this->getChatId(),
                'phone_number' => $this->getPhoneNumber(),
                'first_name'   => $this->getFirstName(),
                'last_name'    => $this->getLastName(),
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
     */
    public function setChatId ( $chat_id )
    {
        $this->chat_id = $chat_id;
    }

    /**
     * @return string
     */
    public function getPhoneNumber ()
    {
        return $this->phone_number;
    }

    /**
     * @param string $phone_number
     */
    public function setPhoneNumber ( $phone_number )
    {
        $this->phone_number = $phone_number;
    }

    /**
     * @return string
     */
    public function getFirstName ()
    {
        return $this->first_name;
    }

    /**
     * @param string $first_name
     */
    public function setFirstName ( $first_name )
    {
        $this->first_name = $first_name;
    }

    /**
     * @return string
     */
    public function getLastName ()
    {
        return $this->last_name;
    }

    /**
     * @param string $last_name
     */
    public function setLastName ( $last_name )
    {
        $this->last_name = $last_name;
    }

    protected function configure ()
    {
        $this
            ->addConstraintsConfiguration( 'chat_id', new ConstraintsConfiguration( [ new IsInteger() ], false ) )
            ->addConstraintsConfiguration( 'chat_id', new ConstraintsConfiguration( [ new IsString( true ) ], false ) )
            ->addConstraintsConfiguration( 'phone_number', new ConstraintsConfiguration( [ new IsString( true ) ], false ) )
            ->addConstraintsConfiguration( 'first_name', new ConstraintsConfiguration( [ new IsString( true ) ], false ) )
            ->addConstraintsConfiguration( 'last_name', new ConstraintsConfiguration( [ new IsString( true ) ], true ) );

        parent::configure();

        return $this;
    }
}