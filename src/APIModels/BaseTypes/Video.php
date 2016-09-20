<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:05
 */

namespace TelegramBotLibrary\APIModels\BaseTypes;

use TelegramBotLibrary\APIModels\BaseModels\BaseModel;
use TelegramBotLibrary\APIModels\BaseModels\CreateWithTypes;

class Video extends BaseModel
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
     * @var integer
     */
    public $duration;

    /**
     * @var PhotoSize
     */
    public $thumb;

    /**
     * @var string
     */
    public $mime_type;

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
            ->setCreateWithConfiguration( 'duration', CreateWithTypes::Scalar, 'integer' )
            ->setCreateWithConfiguration( 'thumb', CreateWithTypes::Object, PhotoSize::class )
            ->setCreateWithConfiguration( 'mime_type', CreateWithTypes::Scalar, 'string' )
            ->setCreateWithConfiguration( 'file_size', CreateWithTypes::Scalar, 'integer' );
    }
}