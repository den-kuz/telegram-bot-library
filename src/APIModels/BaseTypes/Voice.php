<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:06
 */

namespace TelegramBotLibrary\APIModels\BaseTypes;

use TelegramBotLibrary\APIModels\BaseModels\BaseModel;
use TelegramBotLibrary\APIModels\BaseModels\CreateWithTypes;

class Voice extends BaseModel
{
    /**
     * @var string
     */
    public $file_id;

    /**
     * @var integer
     */
    public $duration;

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
            ->setCreateWithConfiguration( 'duration', CreateWithTypes::Scalar, 'integer' )
            ->setCreateWithConfiguration( 'mime_type', CreateWithTypes::Scalar, 'string' )
            ->setCreateWithConfiguration( 'file_size', CreateWithTypes::Scalar, 'integer' );
    }
}