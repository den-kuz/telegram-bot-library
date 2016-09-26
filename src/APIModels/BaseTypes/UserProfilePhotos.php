<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 21:20
 */

namespace TelegramBotLibrary\APIModels\BaseTypes;

use TelegramBotLibrary\APIModels\BaseModels\CreateType;
use TelegramBotLibrary\APIModels\BaseModels\MapDataModel;
use TelegramBotLibrary\APIModels\Enums\ScalarCreateTypes;
use TelegramBotLibrary\APIModels\Enums\SystemCreateTypes;

class UserProfilePhotos extends MapDataModel
{
    /**
     * @var integer
     */
    public $total_count;

    /**
     * @var PhotoSize[][]
     */
    public $photos;



    protected function configure ( $data )
    {
        $this
            ->setCreateType( 'total_count', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::INTEGER ) )
            ->setCreateType( 'photos', new CreateType( SystemCreateTypes::ArrayOfArrayOfObjects, PhotoSize::class ) );

        return $this;
    }
}