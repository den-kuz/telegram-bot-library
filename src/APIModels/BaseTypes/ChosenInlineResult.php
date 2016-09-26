<?php

namespace TelegramBotLibrary\APIModels\BaseTypes;

use TelegramBotLibrary\APIModels\BaseModels\CreateType;
use TelegramBotLibrary\APIModels\BaseModels\MapDataModel;
use TelegramBotLibrary\APIModels\Enums\ScalarCreateTypes;
use TelegramBotLibrary\APIModels\Enums\SystemCreateTypes;

class ChosenInlineResult extends MapDataModel
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
            ->setCreateType( 'result_id', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::STRING ) )
            ->setCreateType( 'from', new CreateType( SystemCreateTypes::Object, User::class ) )
            ->setCreateType( 'location', new CreateType( SystemCreateTypes::Object, Location::class ) )
            ->setCreateType( 'inline_message_id', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::STRING ) )
            ->setCreateType( 'query', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::STRING ) );

        return $this;
    }
}