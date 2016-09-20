<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 21:20
 */

namespace TelegramBotLibrary\APIModels\BaseTypes;


use TelegramBotLibrary\APIModels\BaseModels\BaseModel;
use TelegramBotLibrary\APIModels\BaseModels\CreateWithTypes;

class UserProfilePhotos extends BaseModel
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
            ->setCreateWithConfiguration( 'total_count', CreateWithTypes::Scalar, 'integer' )
            ->setCreateWithConfiguration( 'photos', CreateWithTypes::ArrayOfArrayOfObjects, PhotoSize::class );
    }
}