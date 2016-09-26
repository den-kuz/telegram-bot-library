<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:05
 */

namespace TelegramBotLibrary\APIModels\BaseTypes;

use TelegramBotLibrary\APIModels\BaseModels\CreateType;
use TelegramBotLibrary\APIModels\BaseModels\MapDataModel;
use TelegramBotLibrary\APIModels\Enums\ScalarCreateTypes;
use TelegramBotLibrary\APIModels\Enums\SystemCreateTypes;

class User extends MapDataModel
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var string
     */
    public $first_name;

    /**
     * @var string
     */
    public $last_name;

    /**
     * @var string
     */
    public $username;



    protected function configure ( $data )
    {
        $this
            ->setCreateType( 'id', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::INTEGER ) )
            ->setCreateType( 'first_name', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::STRING ) )
            ->setCreateType( 'last_name', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::STRING ) )
            ->setCreateType( 'username', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::STRING ) );

        return $this;
    }
}