<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 23:35
 */

namespace TelegramBotLibrary\APIModels\BaseTypes;

use TelegramBotLibrary\APIModels\BaseModels\CreateType;
use TelegramBotLibrary\APIModels\BaseModels\MapDataModel;
use TelegramBotLibrary\APIModels\Enums\ScalarCreateTypes;
use TelegramBotLibrary\APIModels\Enums\SystemCreateTypes;

class File extends MapDataModel
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
            ->setCreateType( 'file_id', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::STRING ) )
            ->setCreateType( 'file_size', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::INTEGER ) )
            ->setCreateType( 'file_path', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::STRING ) );

        return $this;
    }
}