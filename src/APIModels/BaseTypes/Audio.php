<?php

namespace TelegramBotLibrary\APIModels\BaseTypes;

use TelegramBotLibrary\APIModels\BaseModels\CreateType;
use TelegramBotLibrary\APIModels\BaseModels\MapDataModel;
use TelegramBotLibrary\APIModels\Enums\ScalarCreateTypes;
use TelegramBotLibrary\APIModels\Enums\SystemCreateTypes;

class Audio extends MapDataModel
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
    public $performer;

    /**
     * @var string
     */
    public $title;

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
            ->setCreateType( 'performer', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::STRING ) )
            ->setCreateType( 'title', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::STRING ) )
            ->setCreateType( 'mime_type', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::STRING ) )
            ->setCreateType( 'file_size', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::INTEGER ) );

        return $this;
    }
}