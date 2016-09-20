<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:02
 */

namespace TelegramBotLibrary\APIModels\BaseTypes;


use TelegramBotLibrary\APIModels\BaseModels\BaseModel;
use TelegramBotLibrary\APIModels\BaseModels\CreateWithTypes;

class Location extends BaseModel
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
            ->setCreateWithConfiguration( 'longitude', CreateWithTypes::Scalar, 'float' )
            ->setCreateWithConfiguration( 'latitude', CreateWithTypes::Scalar, 'float' );
    }
}