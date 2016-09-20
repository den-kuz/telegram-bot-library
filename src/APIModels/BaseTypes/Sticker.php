<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:04
 */

namespace TelegramBotLibrary\APIModels\BaseTypes;

use TelegramBotLibrary\APIModels\BaseModels\BaseModel;
use TelegramBotLibrary\APIModels\BaseModels\CreateWithTypes;

class Sticker extends BaseModel
{
    /**
     * @var string
     */
    public $file_id;

    /**
     * @var integer
     */
    public $width;

    /**
     * @var integer
     */
    public $height;

    /**
     * @var PhotoSize
     */
    public $thumb;

    /**
     * @var string
     */
    public $emoji;

    /**
     * @var integer
     */
    public $file_size;

    protected function configure ( $data )
    {
        $this
            ->setCreateWithConfiguration( 'file_id', CreateWithTypes::Scalar, 'string' )
            ->setCreateWithConfiguration( 'width', CreateWithTypes::Scalar, 'integer' )
            ->setCreateWithConfiguration( 'height', CreateWithTypes::Scalar, 'integer' )
            ->setCreateWithConfiguration( 'thumb', CreateWithTypes::Object, PhotoSize::class )
            ->setCreateWithConfiguration( 'emoji', CreateWithTypes::Scalar, 'string' )
            ->setCreateWithConfiguration( 'file_size', CreateWithTypes::Scalar, 'integer' );
    }
}