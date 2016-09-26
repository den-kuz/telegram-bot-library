<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 26.09.2016
 * Time: 14:30
 */

namespace TelegramBotLibrary\APIModels\ActionModels\_Selectors;

use TelegramBotLibrary\APIModels\BaseModels\SendModel;
use TelegramBotLibrary\APIModels\Constraints\ConstraintsConfiguration;
use TelegramBotLibrary\APIModels\Constraints\IsString;

class FileSelector extends SendModel
{
    /**
     * @var string
     */
    protected $file_id;

    protected function configure ()
    {
        $this
            ->addConstraintsConfiguration( 'file_id', new ConstraintsConfiguration( [ new IsString() ], false ) );

        return $this;
    }

    protected function getProperties ()
    {
        return [
            'file_id' => $this->getFileId(),
        ];
    }

    /**
     * @return int|string
     */
    public function getFileId ()
    {
        return $this->file_id;
    }

    /**
     * @param $file_id
     *
     * @return FileSelector
     */
    public function setFileId ( $file_id )
    {
        $this->file_id = $file_id;

        return $this;
    }
}