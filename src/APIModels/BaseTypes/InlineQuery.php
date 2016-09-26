<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 19.09.2016
 * Time: 15:46
 */

namespace TelegramBotLibrary\APIModels\BaseTypes;


use TelegramBotLibrary\APIModels\BaseModels\CreateType;
use TelegramBotLibrary\APIModels\BaseModels\MapDataModel;
use TelegramBotLibrary\APIModels\Enums\ScalarCreateTypes;
use TelegramBotLibrary\APIModels\Enums\SystemCreateTypes;

class InlineQuery extends MapDataModel
{
    /**
     * @var string
     */
    public $id;

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
    public $query;

    /**
     * @var string
     */
    public $offset;



    protected function configure ( $data )
    {
        $this
            ->setCreateType( 'id', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::STRING ) )
            ->setCreateType( 'from', new CreateType( SystemCreateTypes::Object, User::class ) )
            ->setCreateType( 'location', new CreateType( SystemCreateTypes::Object, Location::class ) )
            ->setCreateType( 'query', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::STRING ) )
            ->setCreateType( 'offset', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::STRING ) );

        return $this;
    }
}