<?php

namespace TelegramBotLibrary\APIModels\BaseTypes;

use TelegramBotLibrary\APIModels\BaseModels\CreateType;
use TelegramBotLibrary\APIModels\BaseModels\MapDataModel;
use TelegramBotLibrary\APIModels\Enums\ScalarCreateTypes;
use TelegramBotLibrary\APIModels\Enums\SystemCreateTypes;

class Location extends MapDataModel
{
    /**
     * @var float
     */
    public $longitude;

    /**
     * @var float
     */
    public $latitude;



    protected function configure ( $data )
    {
        $this
            ->setCreateType( 'longitude', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::FLOAT ) )
            ->setCreateType( 'latitude', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::FLOAT ) );

        return $this;
    }
}