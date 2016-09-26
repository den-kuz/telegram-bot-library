<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:24
 */

namespace TelegramBotLibrary\APIModels\ActionModels\Send;

use TelegramBotLibrary\APIModels\BaseTypes\InputFile;
use TelegramBotLibrary\APIModels\Constraints\ConstraintsConfiguration;
use TelegramBotLibrary\APIModels\Constraints\IsInteger;
use TelegramBotLibrary\APIModels\Constraints\IsObject;
use TelegramBotLibrary\APIModels\Constraints\IsString;
use TelegramBotLibrary\APIModels\Constraints\IsStringLength;
use TelegramBotLibrary\APIModels\FileSystemHelper;

class SendPhoto extends _GeneralSendModel
{
    /**
     * @var integer|string
     */
    protected $chat_id;

    /**
     * @var string|InputFile
     */
    protected $photo;

    /**
     * @var string
     */
    protected $caption;

    public function setPhotoByPath ( $path, $mime = null, $postname = null )
    {
        $this->setPhoto( FileSystemHelper::inputFileByPath( $path, $mime, $postname ) );
    }

    public function setPhotoByFileId ( $id )
    {
        $this->setPhoto( FileSystemHelper::inputFileByFileId( $id ) );
    }

    protected function configure ()
    {
        parent::configure();

        $this
            ->addConstraintsConfiguration( 'chat_id', new ConstraintsConfiguration( [ new IsInteger() ], false ) )
            ->addConstraintsConfiguration( 'chat_id', new ConstraintsConfiguration( [ new IsString( true ) ], false ) )
            ->addConstraintsConfiguration( 'photo', new ConstraintsConfiguration( [ new IsObject( InputFile::class ) ], false ) )
            ->addConstraintsConfiguration( 'photo', new ConstraintsConfiguration( [ new IsString() ], false ) )
            ->addConstraintsConfiguration( 'caption', new ConstraintsConfiguration( [ new IsStringLength( 0, 200 ) ], true ) );

        return $this;
    }

    protected function getProperties ()
    {
        return array_merge(
            [
                'chat_id' => $this->getChatId(),
                'photo'   => $this->getPhoto(),
                'caption' => $this->getCaption(),
            ],
            parent::getProperties()
        );
    }

    /**
     * @return int|string
     */
    public function getChatId ()
    {
        return $this->chat_id;
    }

    /**
     * @param int|string $chat_id
     *
     * @return SendPhoto
     */
    public function setChatId ( $chat_id )
    {
        $this->chat_id = $chat_id;

        return $this;
    }

    /**
     * @return string|InputFile
     */
    public function getPhoto ()
    {
        return $this->photo;
    }

    /**
     * @param string|InputFile $photo
     *
     * @return SendPhoto
     */
    public function setPhoto ( $photo )
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return string
     */
    public function getCaption ()
    {
        return $this->caption;
    }

    /**
     * @param string $caption
     *
     * @return SendPhoto
     */
    public function setCaption ( $caption )
    {
        $this->caption = $caption;

        return $this;
    }
}