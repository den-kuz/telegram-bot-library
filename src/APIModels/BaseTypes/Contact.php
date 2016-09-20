<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:01
 */

namespace TelegramBotLibrary\APIModels\BaseTypes;


use TelegramBotLibrary\APIModels\BaseModels\BaseModel;
use TelegramBotLibrary\APIModels\BaseModels\CreateWithTypes;

class Contact extends BaseModel
{
    /**
     * @var string
     */
    public $phone_number;

    /**
     * @var string
     */
    public $first_name;

    /**
     * @var string
     */
    public $last_name;

    /**
     * @var integer
     */
    public $user_id;

    protected function configure ( $data )
    {
        $this
            ->setCreateWithConfiguration( 'phone_number', CreateWithTypes::Scalar, 'string' )
            ->setCreateWithConfiguration( 'first_name', CreateWithTypes::Scalar, 'string' )
            ->setCreateWithConfiguration( 'last_name', CreateWithTypes::Scalar, 'string' )
            ->setCreateWithConfiguration( 'user_id', CreateWithTypes::Scalar, 'integer' );
    }
}