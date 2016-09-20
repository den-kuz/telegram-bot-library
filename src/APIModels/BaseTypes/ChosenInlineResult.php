<?php

namespace TelegramBotLibrary\APIModels\BaseTypes;

use TelegramBotLibrary\APIModels\BaseModels\BaseModel;
use TelegramBotLibrary\APIModels\BaseModels\CreateWithTypes;

class ChosenInlineResult extends BaseModel
{
    /**
     * @var string
     */
    public $result_id;

    /**
     * @var User
     */
    public $from;

    /**
     * @var Location
     */
    public $location;

    /**
     * @var string
     */
    public $inline_message_id;

    /**
     * @var string
     */
    public $query;

    protected function configure ( $data )
    {
        $this
            ->setCreateWithConfiguration( 'result_id', CreateWithTypes::Scalar, 'string' )
            ->setCreateWithConfiguration( 'from', CreateWithTypes::Object, User::class )
            ->setCreateWithConfiguration( 'location', CreateWithTypes::Object, Location::class )
            ->setCreateWithConfiguration( 'inline_message_id', CreateWithTypes::Scalar, 'string' )
            ->setCreateWithConfiguration( 'query', CreateWithTypes::Scalar, 'string' );
    }
}