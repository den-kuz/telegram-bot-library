<?php

namespace TelegramBotLibrary\APIModels\ActionModels\Send;

use TelegramBotLibrary\APIModels\Constraints\ConstraintsConfiguration;
use TelegramBotLibrary\APIModels\Constraints\IsString;

class SendVenue extends SendLocation
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $address;

    /**
     * @var string
     */
    protected $foursquare_id;

    protected function getProperties ()
    {
        return array_merge(
            [
                'title'         => $this->getTitle(),
                'address'       => $this->getAddress(),
                'foursquare_id' => $this->getFoursquareId(),
            ],
            parent::getProperties()
        );
    }

    /**
     * @return string
     */
    public function getTitle ()
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return SendVenue
     */
    public function setTitle ( $title )
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getAddress ()
    {
        return $this->address;
    }

    /**
     * @param string $address
     *
     * @return SendVenue
     */
    public function setAddress ( $address )
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return string
     */
    public function getFoursquareId ()
    {
        return $this->foursquare_id;
    }

    /**
     * @param string $foursquare_id
     *
     * @return SendVenue
     */
    public function setFoursquareId ( $foursquare_id )
    {
        $this->foursquare_id = $foursquare_id;

        return $this;
    }

    protected function configure ()
    {
        parent::configure();

        $this
            ->addConstraintsConfiguration( 'title', new ConstraintsConfiguration( [ new IsString() ], false ) )
            ->addConstraintsConfiguration( 'address', new ConstraintsConfiguration( [ new IsString() ], false ) )
            ->addConstraintsConfiguration( 'foursquare_id', new ConstraintsConfiguration( [ new IsString() ], true ) );

        return $this;
    }

}