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

class User extends BaseModel
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
            ->setCreateWithConfiguration( 'id', CreateWithTypes::Scalar, 'integer' )
            ->setCreateWithConfiguration( 'first_name', CreateWithTypes::Scalar, 'string' )
            ->setCreateWithConfiguration( 'last_name', CreateWithTypes::Scalar, 'string' )
            ->setCreateWithConfiguration( 'username', CreateWithTypes::Scalar, 'string' );
    }
}