<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 07.07.2016
 * Time: 23:34
 */

namespace TelegramBotLibrary\APIModels\ActionModels\Set;

use TelegramBotLibrary\APIModels\BaseModels\SendModel;
use TelegramBotLibrary\APIModels\BaseTypes\InputFile;
use TelegramBotLibrary\APIModels\Constraints\ConstraintsConfiguration;
use TelegramBotLibrary\APIModels\Constraints\IsObject;
use TelegramBotLibrary\APIModels\Constraints\IsString;
use TelegramBotLibrary\APIModels\InputFileHelper;

class SetWebhook extends SendModel
{
    /**
     * @var string
     */
    protected $url;

    /**
     * @var InputFile
     */
    protected $certificate;

    public function setCertificateByPath ( $path, $mime = null, $postname = null )
    {
        return $this->setCertificate( InputFileHelper::inputFileByPath( $path, $mime, $postname ) );
    }

    protected function configure ()
    {
        $this
            ->addConstraintsConfiguration( 'url', new ConstraintsConfiguration( [ new IsString( true ) ], true ) )
            ->addConstraintsConfiguration( 'certificate', new ConstraintsConfiguration( [ new IsObject( InputFile::class ) ], true ) );

        return $this;
    }

    protected function getProperties ()
    {
        return [
            'url'         => $this->getUrl(),
            'certificate' => $this->getCertificate(),
        ];
    }

    /**
     * @return string|null
     */
    public function getUrl ()
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return SetWebhook
     */
    public function setUrl ( $url )
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return InputFile|null
     */
    public function getCertificate ()
    {
        return $this->certificate;
    }

    /**
     * @param InputFile $certificate
     *
     * @return SetWebhook
     */
    public function setCertificate ( InputFile $certificate )
    {
        $this->certificate = $certificate;

        return $this;
    }
}