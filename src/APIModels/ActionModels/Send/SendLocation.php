<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:23
 */

namespace TelegramBotLibrary\APIModels\ActionModels\Send;

use TelegramBotLibrary\APIModels\Constraints\ConstraintsConfiguration;
use TelegramBotLibrary\APIModels\Constraints\IsFloat;
use TelegramBotLibrary\APIModels\Constraints\IsInteger;
use TelegramBotLibrary\APIModels\Constraints\IsString;

class SendLocation extends _GeneralSendModel
{
    /**
     * @var integer | string
     */
    protected $chat_id;

    /**
     * @var float
     */
    protected $latitude;

    /**
     * @var float
     */
    protected $longitude;

    protected function getProperties ()
    {
        return array_merge(
            [
                'chat_id'   => $this->getChatId(),
                'latitude'  => $this->getLatitude(),
                'longitude' => $this->getLongitude(),
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
     * @return SendLocation
     */
    public function setChatId ( $chat_id )
    {
        $this->chat_id = $chat_id;

        return $this;
    }

    /**
     * @return float
     */
    public function getLatitude ()
    {
        return $this->latitude;
    }

    /**
     * @param float $latitude
     *
     * @return SendLocation
     */
    public function setLatitude ( $latitude )
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * @return float
     */
    public function getLongitude ()
    {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     *
     * @return SendLocation
     */
    public function setLongitude ( $longitude )
    {
        $this->longitude = $longitude;

        return $this;
    }

    protected function configure ()
    {
        $this
            ->addConstraintsConfiguration( 'chat_id', new ConstraintsConfiguration( [ new IsInteger() ], false ) )
            ->addConstraintsConfiguration( 'chat_id', new ConstraintsConfiguration( [ new IsString( true ) ], false ) )
            ->addConstraintsConfiguration( 'latitude', new ConstraintsConfiguration( [ new IsFloat() ], false ) )
            ->addConstraintsConfiguration( 'longitude', new ConstraintsConfiguration( [ new IsFloat() ], false ) );

        parent::configure();

        return $this;
    }
}