<?php

namespace TelegramBotLibrary\APIModels\ActionModels\Send;

use TelegramBotLibrary\APIModels\BaseTypes\InputFile;
use TelegramBotLibrary\APIModels\Constraints\ConstraintsConfiguration;
use TelegramBotLibrary\APIModels\Constraints\IsInteger;
use TelegramBotLibrary\APIModels\Constraints\IsObject;
use TelegramBotLibrary\APIModels\Constraints\IsString;
use TelegramBotLibrary\APIModels\Constraints\IsStringLength;
use TelegramBotLibrary\APIModels\InputFileHelper;

class SendAudio extends _GeneralSendModel
{
    /**
     * @var integer | string
     */
    protected $chat_id;

    /**
     * @var InputFile | string
     */
    protected $audio;

    /**
     * @var string
     */
    protected $caption;

    /**
     * @var integer
     */
    protected $duration;

    /**
     * @var string
     */
    protected $performer;

    /**
     * @var string
     */
    protected $title;

    public function setAudioByPath ( $path, $mime = null, $postname = null )
    {
        return $this->setAudio( InputFileHelper::inputFileByPath( $path, $mime, $postname ) );
    }

    public function setAudioById ( $id )
    {
        return $this->setAudio( InputFileHelper::inputFileByFileId( $id ) );
    }

    protected function configure ()
    {
        parent::configure();

        $this
            ->addConstraintsConfiguration( 'chat_id', new ConstraintsConfiguration( [ new IsInteger() ], false ) )
            ->addConstraintsConfiguration( 'chat_id', new ConstraintsConfiguration( [ new IsString( true ) ], false ) )
            ->addConstraintsConfiguration( 'audio', new ConstraintsConfiguration( [ new IsObject( InputFile::class ) ], false ) )
            ->addConstraintsConfiguration( 'audio', new ConstraintsConfiguration( [ new IsString() ], false ) )
            ->addConstraintsConfiguration( 'caption', new ConstraintsConfiguration( [ new IsStringLength( 0, 200 ) ], true ) )
            ->addConstraintsConfiguration( 'duration', new ConstraintsConfiguration( [ new IsInteger() ], true ) )
            ->addConstraintsConfiguration( 'performer', new ConstraintsConfiguration( [ new IsString() ], true ) )
            ->addConstraintsConfiguration( 'title', new ConstraintsConfiguration( [ new IsString() ], true ) );

        return $this;
    }

    protected function getProperties ()
    {
        return array_merge(
            [
                'chat_id'   => $this->getChatId(),
                'audio'     => $this->getAudio(),
                'caption'   => $this->getCaption(),
                'duration'  => $this->getDuration(),
                'performer' => $this->getPerformer(),
                'title'     => $this->getTitle(),
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
     * @return SendAudio
     */
    public function setChatId ( $chat_id )
    {
        $this->chat_id = $chat_id;

        return $this;
    }

    /**
     * @return string|InputFile
     */
    public function getAudio ()
    {
        return $this->audio;
    }

    /**
     * @param string|InputFile $audio
     *
     * @return SendAudio
     */
    public function setAudio ( $audio )
    {
        $this->audio = $audio;

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
     * @return SendAudio
     */
    public function setCaption ( $caption )
    {
        $this->caption = $caption;

        return $this;
    }

    /**
     * @return int
     */
    public function getDuration ()
    {
        return $this->duration;
    }

    /**
     * @param int $duration
     *
     * @return SendAudio
     */
    public function setDuration ( $duration )
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @return string
     */
    public function getPerformer ()
    {
        return $this->performer;
    }

    /**
     * @param string $performer
     *
     * @return SendAudio
     */
    public function setPerformer ( $performer )
    {
        $this->performer = $performer;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle ()
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return SendAudio
     */
    public function setTitle ( $title )
    {
        $this->title = $title;

        return $this;
    }
}