<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:38
 */

namespace TelegramBotLibrary\APIModels\BaseTypes;

use TelegramBotLibrary\APIModels\BaseModels\CreateType;
use TelegramBotLibrary\APIModels\BaseModels\MapDataModel;
use TelegramBotLibrary\APIModels\Enums\ScalarCreateTypes;
use TelegramBotLibrary\APIModels\Enums\SystemCreateTypes;

class Venue extends MapDataModel
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
            ->setCreateType( 'location', new CreateType( SystemCreateTypes::Object, Location::class ) )
            ->setCreateType( 'title', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::STRING ) )
            ->setCreateType( 'address', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::STRING ) )
            ->setCreateType( 'foursquare_id', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::STRING ) );

        return $this;
    }
}