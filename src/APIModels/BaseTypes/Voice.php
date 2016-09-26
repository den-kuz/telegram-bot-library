<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:06
 */

namespace TelegramBotLibrary\APIModels\BaseTypes;

use TelegramBotLibrary\APIModels\BaseModels\CreateType;
use TelegramBotLibrary\APIModels\BaseModels\MapDataModel;
use TelegramBotLibrary\APIModels\Enums\ScalarCreateTypes;
use TelegramBotLibrary\APIModels\Enums\SystemCreateTypes;

class Voice extends MapDataModel
{
    /**
     * @var string
     */
    public $file_id;

    /**
     * @var integer
     */
    public $duration;

    /**
     * @var string
     */
    public $mime_type;

    /**
     * @var integer
     */
    public $file_size;



    protected function configure ( $data )
    {
        $this
            ->setCreateType( 'file_id', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::STRING ) )
            ->setCreateType( 'duration', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::INTEGER ) )
            ->setCreateType( 'mime_type', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::STRING ) )
            ->setCreateType( 'file_size', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::INTEGER ) );

        return $this;
    }
}