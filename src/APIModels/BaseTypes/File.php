<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 23:35
 */

namespace TelegramBotLibrary\APIModels\BaseTypes;


use TelegramBotLibrary\APIModels\BaseModels\BaseModel;
use TelegramBotLibrary\APIModels\BaseModels\CreateWithTypes;

class File extends BaseModel
{
    /**
     * @var string
     */
    public $file_id;

    /**
     * @var integer
     */
    public $file_size;

    /**
     * @var string
     */
    public $file_path;

    protected function configure ( $data )
    {
        $this
            ->setCreateWithConfiguration( 'file_id', CreateWithTypes::Scalar, 'string' )
            ->setCreateWithConfiguration( 'file_size', CreateWithTypes::Scalar, 'integer' )
            ->setCreateWithConfiguration( 'file_path', CreateWithTypes::Scalar, 'string' );
    }
}