<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:18
 */

namespace TelegramBotLibrary\APIModels\ActionModels\Send;

use TelegramBotLibrary\APIModels\BaseTypes\InputFile;
use TelegramBotLibrary\APIModels\Constraints\ConstraintsConfiguration;
use TelegramBotLibrary\APIModels\Constraints\IsInteger;
use TelegramBotLibrary\APIModels\Constraints\IsObject;
use TelegramBotLibrary\APIModels\Constraints\IsString;
use TelegramBotLibrary\APIModels\Constraints\IsStringLength;
use TelegramBotLibrary\APIModels\InputFileHelper;

class SendDocument extends _GeneralSendModel
{
    /**
     * @var integer | string
     */
    protected $chat_id;

    /**
     * @var InputFile | string
     */
    protected $document;

    /**
     * @var string
     */
    protected $caption;

    public function setDocumentByPath ( $path, $mime = null, $postname = null )
    {
        return $this->setDocument( InputFileHelper::inputFileByPath( $path, $mime, $postname ) );
    }

    public function setDocumentByFileId ( $id )
    {
        return $this->setDocument( InputFileHelper::inputFileByFileId( $id ) );
    }

    protected function configure ()
    {
        parent::configure();

        $this
            ->addConstraintsConfiguration( 'chat_id', new ConstraintsConfiguration( [ new IsInteger() ], false ) )
            ->addConstraintsConfiguration( 'chat_id', new ConstraintsConfiguration( [ new IsString( true ) ], false ) )
            ->addConstraintsConfiguration( 'document', new ConstraintsConfiguration( [ new IsObject( InputFile::class ) ], false ) )
            ->addConstraintsConfiguration( 'document', new ConstraintsConfiguration( [ new IsString() ], false ) )
            ->addConstraintsConfiguration( 'caption', new ConstraintsConfiguration( [ new IsStringLength( 0, 200 ) ], true ) );

        return $this;
    }

    protected function getProperties ()
    {
        return array_merge(
            [
                'chat_id'  => $this->getChatId(),
                'document' => $this->getDocument(),
                'caption'  => $this->getCaption(),
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
     * @return SendDocument
     */
    public function setChatId ( $chat_id )
    {
        $this->chat_id = $chat_id;

        return $this;
    }

    /**
     * @return string|InputFile
     */
    public function getDocument ()
    {
        return $this->document;
    }

    /**
     * @param string|InputFile $document
     *
     * @return SendDocument
     */
    public function setDocument ( $document )
    {
        $this->document = $document;

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
     * @return SendDocument
     */
    public function setCaption ( $caption )
    {
        $this->caption = $caption;

        return $this;
    }
}