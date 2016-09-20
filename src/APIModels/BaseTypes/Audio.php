<?php

namespace TelegramBotLibrary\APIModels\BaseTypes;

use TelegramBotLibrary\APIModels\BaseModels\BaseModel;
use TelegramBotLibrary\APIModels\BaseModels\CreateWithTypes;

class Audio extends BaseModel
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
    public $performer;

    /**
     * @var string
     */
    public $title;

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
            ->setCreateWithConfiguration( 'performer', CreateWithTypes::Scalar, 'string' )
            ->setCreateWithConfiguration( 'title', CreateWithTypes::Scalar, 'string' )
            ->setCreateWithConfiguration( 'mime_type', CreateWithTypes::Scalar, 'string' )
            ->setCreateWithConfiguration( 'file_size', CreateWithTypes::Scalar, 'integer' );
    }
}