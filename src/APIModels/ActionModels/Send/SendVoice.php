<?php

namespace TelegramBotLibrary\APIModels\ModelsActions\SendEdit;

use TelegramBotLibrary\APIModels\ActionModels\Send\_GeneralSendModel;
use TelegramBotLibrary\APIModels\BaseTypes\InputFile;
use TelegramBotLibrary\APIModels\Constraints\ConstraintsConfiguration;
use TelegramBotLibrary\APIModels\Constraints\IsInteger;
use TelegramBotLibrary\APIModels\Constraints\IsObject;
use TelegramBotLibrary\APIModels\Constraints\IsString;
use TelegramBotLibrary\APIModels\Constraints\IsStringLength;
use TelegramBotLibrary\APIModels\InputFileHelper;

class SendVoice extends _GeneralSendModel
{
    /**
     * @var string|integer
     */
    protected $chat_id;

    /**
     * @var string|InputFile
     */
    protected $voice;

    /**
     * @var string
     */
    protected $caption;

    /**
     * @var integer
     */
    protected $duration;

    public function setVoiceByPath ( $path, $mime = null, $postname = null )
    {
        $this->setVoice( InputFileHelper::inputFileByPath( $path, $mime, $postname ) );
    }

    public function setVoiceByFileId ( $id )
    {
        $this->setVoice( InputFileHelper::inputFileByFileId( $id ) );
    }

    protected function configure ()
    {
        parent::configure();

        $this
            ->addConstraintsConfiguration( 'chat_id', new ConstraintsConfiguration( [ new IsInteger() ], false ) )
            ->addConstraintsConfiguration( 'chat_id', new ConstraintsConfiguration( [ new IsString( true ) ], false ) )
            ->addConstraintsConfiguration( 'voice', new ConstraintsConfiguration( [ new IsObject( InputFile::class ) ], false ) )
            ->addConstraintsConfiguration( 'voice', new ConstraintsConfiguration( [ new IsString() ], false ) )
            ->addConstraintsConfiguration( 'caption', new ConstraintsConfiguration( [ new IsStringLength( 0, 200 ) ], true ) )
            ->addConstraintsConfiguration( 'duration', new ConstraintsConfiguration( [ new IsInteger() ], true ) );

        return $this;
    }

    protected function getProperties ()
    {
        return array_merge(
            [
                'chat_id'  => $this->getChatId(),
                'voice'    => $this->getVoice(),
                'caption'  => $this->getCaption(),
                'duration' => $this->getDuration(),
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
     * @return SendVoice
     */
    public function setChatId ( $chat_id )
    {
        $this->chat_id = $chat_id;

        return $this;
    }

    /**
     * @return string|InputFile
     */
    public function getVoice ()
    {
        return $this->voice;
    }

    /**
     * @param string|InputFile $voice
     *
     * @return SendVoice
     */
    public function setVoice ( $voice )
    {
        $this->voice = $voice;

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
     * @return SendVoice
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
     * @return SendVoice
     */
    public function setDuration ( $duration )
    {
        $this->duration = $duration;

        return $this;
    }
}