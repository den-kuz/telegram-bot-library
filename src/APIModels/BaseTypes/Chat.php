<?php

namespace TelegramBotLibrary\APIModels\BaseTypes;

use TelegramBotLibrary\APIModels\BaseModels\BaseModel;
use TelegramBotLibrary\APIModels\BaseModels\CreateWithTypes;

class Chat extends BaseModel
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $first_name;

    /**
     * @var string
     */
    public $last_name;

    protected function configure ( $data )
    {
        $this
            ->setCreateWithConfiguration( 'id', CreateWithTypes::Scalar, 'integer' )
            ->setCreateWithConfiguration( 'type', CreateWithTypes::Scalar, 'string' )
            ->setCreateWithConfiguration( 'title', CreateWithTypes::Scalar, 'string' )
            ->setCreateWithConfiguration( 'username', CreateWithTypes::Scalar, 'string' )
            ->setCreateWithConfiguration( 'first_name', CreateWithTypes::Scalar, 'string' )
            ->setCreateWithConfiguration( 'last_name', CreateWithTypes::Scalar, 'string' );
    }
}