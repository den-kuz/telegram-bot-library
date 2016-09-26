<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:04
 */

namespace TelegramBotLibrary\APIModels\BaseTypes;

use TelegramBotLibrary\APIModels\BaseModels\CreateType;
use TelegramBotLibrary\APIModels\BaseModels\MapDataModel;
use TelegramBotLibrary\APIModels\Enums\ScalarCreateTypes;
use TelegramBotLibrary\APIModels\Enums\SystemCreateTypes;

class Sticker extends MapDataModel
{
    /**
     * @var string
     */
    public $file_id;

    /**
     * @var integer
     */
    public $width;

    /**
     * @var integer
     */
    public $height;

    /**
     * @var PhotoSize
     */
    public $thumb;

    /**
     * @var string
     */
    public $emoji;

    /**
     * @var integer
     */
    public $file_size;



    protected function configure ( $data )
    {
        $this
            ->setCreateType( 'file_id', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::STRING ) )
            ->setCreateType( 'width', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::INTEGER ) )
            ->setCreateType( 'height', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::INTEGER ) )
            ->setCreateType( 'thumb', new CreateType( SystemCreateTypes::Object, PhotoSize::class ) )
            ->setCreateType( 'emoji', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::STRING ) )
            ->setCreateType( 'file_size', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::INTEGER ) );

        return $this;
    }
}