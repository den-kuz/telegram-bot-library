<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:38
 */

namespace TelegramBotLibrary\APIModels\BaseTypes;


use TelegramBotLibrary\APIModels\BaseModels\BaseModel;
use TelegramBotLibrary\APIModels\BaseModels\CreateWithTypes;

class Venue extends BaseModel
{
    /**
     * @var Location
     */
    public $location;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $address;

    /**
     * @var string
     */
    public $foursquare_id;

    protected function configure ( $data )
    {
        $this
            ->setCreateWithConfiguration( 'location', CreateWithTypes::Object, Location::class )
            ->setCreateWithConfiguration( 'title', CreateWithTypes::Scalar, 'string' )
            ->setCreateWithConfiguration( 'address', CreateWithTypes::Scalar, 'string' )
            ->setCreateWithConfiguration( 'foursquare_id', CreateWithTypes::Scalar, 'string' );
    }
}