<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 19.09.2016
 * Time: 15:46
 */

namespace TelegramBotLibrary\APIModels\BaseTypes;


use TelegramBotLibrary\APIModels\BaseModels\BaseModel;
use TelegramBotLibrary\APIModels\BaseModels\CreateWithTypes;

class InlineQuery extends BaseModel
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
            ->setCreateWithConfiguration( 'id', CreateWithTypes::Scalar, 'string' )
            ->setCreateWithConfiguration( 'from', CreateWithTypes::Object, User::class )
            ->setCreateWithConfiguration( 'location', CreateWithTypes::Object, Location::class )
            ->setCreateWithConfiguration( 'query', CreateWithTypes::Scalar, 'string' )
            ->setCreateWithConfiguration( 'offset', CreateWithTypes::Scalar, 'string' );
    }
}