<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:26
 */

namespace TelegramBotLibrary\APIModels\ModelsActions\SendEdit;

use TelegramBotLibrary\APIModels\ActionModels\Send\_GeneralSendModel;
use TelegramBotLibrary\APIModels\BaseTypes\InputFile;
use TelegramBotLibrary\APIModels\Constraints\ConstraintsConfiguration;
use TelegramBotLibrary\APIModels\Constraints\IsInteger;
use TelegramBotLibrary\APIModels\Constraints\IsObject;
use TelegramBotLibrary\APIModels\Constraints\IsString;
use TelegramBotLibrary\APIModels\Constraints\IsStringLength;
use TelegramBotLibrary\APIModels\FileSystemHelper;

class SendVideo extends _GeneralSendModel
{
    /**
     * @var string|integer
     */
    protected $chat_id;

    /**
     * @var string|InputFile
     */
    protected $video;

    /**
     * @var integer
     */
    protected $duration;

    /**
     * @var integer
     */
    protected $width;

    /**
     * @var integer
     */
    protected $height;

    /**
     * @var string
     */
    protected $caption;

    public function setVideoByPath ( $path, $mime = null, $postname = null )
    {
        $this->setVideo( FileSystemHelper::inputFileByPath( $path, $mime, $postname ) );
    }

    public function setVideoByFileId ( $id )
    {
        $this->setVideo( FileSystemHelper::inputFileByFileId( $id ) );
    }

    protected function configure ()
    {
        parent::configure();

        $this
            ->addConstraintsConfiguration( 'chat_id', new ConstraintsConfiguration( [ new IsInteger() ], false ) )
            ->addConstraintsConfiguration( 'chat_id', new ConstraintsConfiguration( [ new IsString( true ) ], false ) )
            ->addConstraintsConfiguration( 'video', new ConstraintsConfiguration( [ new IsObject( InputFile::class ) ], false ) )
            ->addConstraintsConfiguration( 'video', new ConstraintsConfiguration( [ new IsString() ], false ) )
            ->addConstraintsConfiguration( 'duration', new ConstraintsConfiguration( [ new IsInteger() ], true ) )
            ->addConstraintsConfiguration( 'width', new ConstraintsConfiguration( [ new IsInteger() ], true ) )
            ->addConstraintsConfiguration( 'height', new ConstraintsConfiguration( [ new IsInteger() ], true ) )
            ->addConstraintsConfiguration( 'caption', new ConstraintsConfiguration( [ new IsStringLength( 0, 200 ) ], true ) );

        return $this;
    }

    protected function getProperties ()
    {
        return array_merge(
            [
                'chat_id'  => $this->getChatId(),
                'video'    => $this->getVideo(),
                'duration' => $this->getDuration(),
                'width'    => $this->getWidth(),
                'height'   => $this->getHeight(),
                'caption'  => $this->getCaption(),
            ],
            parent::getProperties()
        );
    }

    /**
     * @return string|int
     */
    public function getChatId ()
    {
        return $this->chat_id;
    }

    /**
     * @param string|int $chat_id
     *
     * @return SendVideo
     */
    public function setChatId ( $chat_id )
    {
        $this->chat_id = $chat_id;

        return $this;
    }

    /**
     * @return string|InputFile
     */
    public function getVideo ()
    {
        return $this->video;
    }

    /**
     * @param string|InputFile $video
     *
     * @return SendVideo
     */
    public function setVideo ( $video )
    {
        $this->video = $video;

        return $this;
    }

    /**
     * @return integer
     */
    public function getDuration ()
    {
        return $this->duration;
    }

    /**
     * @param integer $duration
     *
     * @return SendVideo
     */
    public function setDuration ( $duration )
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @return int
     */
    public function getWidth ()
    {
        return $this->width;
    }

    /**
     * @param int $width
     *
     * @return SendVideo
     */
    public function setWidth ( $width )
    {
        $this->width = $width;

        return $this;
    }

    /**
     * @return int
     */
    public function getHeight ()
    {
        return $this->height;
    }

    /**
     * @param int $height
     *
     * @return SendVideo
     */
    public function setHeight ( $height )
    {
        $this->height = $height;

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
     * @return SendVideo
     */
    public function setCaption ( $caption )
    {
        $this->caption = $caption;

        return $this;
    }

}