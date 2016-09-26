<?php

namespace TelegramBotLibrary\APIModels\ModelsActions\SendEdit;

use TelegramBotLibrary\APIModels\ActionModels\Send\_GeneralSendModel;
use TelegramBotLibrary\APIModels\BaseTypes\InputFile;
use TelegramBotLibrary\APIModels\Constraints\ConstraintsConfiguration;
use TelegramBotLibrary\APIModels\Constraints\IsInteger;
use TelegramBotLibrary\APIModels\Constraints\IsObject;
use TelegramBotLibrary\APIModels\Constraints\IsString;
use TelegramBotLibrary\APIModels\FileSystemHelper;

class SendSticker extends _GeneralSendModel
{
    /**
     * @var string|integer
     */
    protected $chat_id;

    /**
     * @var string|InputFile
     */
    protected $sticker;

    public function setStickerByPath ( $path, $mime = null, $postname = null )
    {
        $this->setSticker( FileSystemHelper::inputFileByPath( $path, $mime, $postname ) );
    }

    public function setStickerByFileId ( $id )
    {
        $this->setSticker( FileSystemHelper::inputFileByFileId( $id ) );
    }

    protected function configure ()
    {
        parent::configure();

        $this
            ->addConstraintsConfiguration( 'chat_id', new ConstraintsConfiguration( [ new IsInteger() ], false ) )
            ->addConstraintsConfiguration( 'chat_id', new ConstraintsConfiguration( [ new IsString( true ) ], false ) )
            ->addConstraintsConfiguration( 'sticker', new ConstraintsConfiguration( [ new IsObject( InputFile::class ) ], false ) )
            ->addConstraintsConfiguration( 'sticker', new ConstraintsConfiguration( [ new IsString() ], false ) );

        return $this;
    }

    protected function getProperties ()
    {
        return array_merge(
            [
                'chat_id' => $this->getChatId(),
                'sticker' => $this->getSticker(),
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
     * @return SendSticker
     */
    public function setChatId ( $chat_id )
    {
        $this->chat_id = $chat_id;

        return $this;
    }

    /**
     * @return string|InputFile
     */
    public function getSticker ()
    {
        return $this->sticker;
    }

    /**
     * @param string|InputFile $sticker
     *
     * @return SendSticker
     */
    public function setSticker ( $sticker )
    {
        $this->sticker = $sticker;

        return $this;
    }
}