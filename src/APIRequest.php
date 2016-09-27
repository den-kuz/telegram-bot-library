<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 19:51
 */

namespace TelegramBotLibrary;

use TelegramBotLibrary\APIModels\FileSystemHelper;
use TelegramBotLibrary\Exceptions\HTTPException;
use TelegramBotLibrary\Exceptions\TelegramException;
use TelegramBotLibrary\Exceptions\TelegramRuntimeException;

class APIRequest
{
    const API_REQUESTS_URL_TEMPLATE = 'https://api.telegram.org/bot{{token}}/{{method}}';
    const API_FILES_URL_TEMPLATE = 'https://api.telegram.org/file/bot{{token}}/{{path}}';

    private $apiRequestUrl;

    private $apiFilesUrl;

    private $botToken;

    /**
     * APIRequest constructor.
     *
     * @param string $botToken
     */
    public function __construct ( $botToken )
    {
        $this->botToken = $botToken;

        $this->apiRequestUrl = str_replace( '{{token}}', $this->botToken, self::API_REQUESTS_URL_TEMPLATE );
        $this->apiFilesUrl = str_replace( '{{token}}', $this->botToken, self::API_FILES_URL_TEMPLATE );
    }

    /**
     * Makes query to Telegram Bots API
     * Returns result as associative array
     *
     * @param string $method - callig method
     * @param array $parameters - parameters array
     *
     * @param bool $getDescription
     *
     * @return array
     * @throws TelegramException
     */
    public function query ( $method, $parameters = null, $getDescription = false )
    {
        $postFields = is_array( $parameters );
        $contentType = $postFields ? 'multipart/form-data' : 'application/json';

        // CURL init
        // ---------------------------------------------------------------
        $curlDescriptor = curl_init( $this->getApiUrl( $method ) );
        curl_setopt_array(
            $curlDescriptor,
            [
                CURLOPT_POST           => true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER     => [ 'Content-Type: ' . $contentType ],
                CURLOPT_FOLLOWLOCATION => 1,
                CURLOPT_SSL_VERIFYPEER => 0,
            ]
        );

        if ( $postFields ) curl_setopt( $curlDescriptor, CURLOPT_POSTFIELDS, $parameters );
        // ---------------------------------------------------------------

        $apiResponse = curl_exec( $curlDescriptor );

        $apiResponse = json_decode( $apiResponse, true );
        curl_close( $curlDescriptor );

        if ( !isset( $apiResponse[ 'ok' ] ) ) {
            throw new HTTPException( 'Data not received', 1000 );
        } elseif ( $apiResponse[ 'ok' ] == false ) {
            throw new TelegramRuntimeException( $apiResponse[ 'description' ], $apiResponse[ 'error_code' ] );
        } elseif ( ( $apiResponse[ 'ok' ] == true ) && ( isset( $apiResponse[ 'result' ] ) ) ) {
            if ( isset( $apiResponse[ 'description' ] ) && $getDescription ) {
                return [
                    'result'      => $apiResponse[ 'result' ],
                    'description' => $apiResponse[ 'description' ],
                ];
            } else {
                return $apiResponse[ 'result' ];
            }
        }

        return [];
    }

    /**
     * Returns full URL to Telegram Bots API by method
     *
     * @param $method
     *
     * @return string
     */
    private function getApiUrl ( $method )
    {
        return str_replace( '{{method}}', $method, $this->apiRequestUrl );
    }

    /**
     * Download file from Telegram
     *
     * Returns path to downloaded file
     *
     * @param string $serverPath - path to file on Teleram server
     * @param string $saveDir - save directory
     * @param string $saveFilename - save filename
     * @param string $saveFileExtension - save file extension
     *
     * @return string
     */
    public function downloadTelegramFile ( $serverPath, $saveDir = './', $saveFilename = null, $saveFileExtension = null )
    {
        return static::downloadFile( $this->getFileUrl( $serverPath ), $saveDir, $saveFilename, $saveFileExtension );
    }

    /**
     * Download file
     *
     * Returns path to downloaded file
     *
     * @param string $link - url to file
     * @param string $saveDir - save directory
     * @param null $saveFilename - save filename
     * @param null $saveFileExtension - save file extension
     *
     * @return string
     * @throws HTTPException
     * @throws TelegramRuntimeException
     */
    private static function downloadFile ( $link, $saveDir = './', $saveFilename = null, $saveFileExtension = null )
    {
        $curlDescriptor = curl_init( $link );
        curl_setopt_array(
            $curlDescriptor,
            [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER         => 0,
                CURLOPT_FOLLOWLOCATION => 1,
                CURLOPT_SSL_VERIFYPEER => 0,
            ]
        );

        $fileContent = curl_exec( $curlDescriptor );
        $code = curl_getinfo( $curlDescriptor, CURLINFO_HTTP_CODE );
        curl_close( $curlDescriptor );

        if ( $code !== 200 ) throw new HTTPException( 'File not found' );
        if ( empty( $fileContent ) ) throw new TelegramRuntimeException( 'File is empty' );

        return FileSystemHelper::saveContent(
            $fileContent,
            $saveDir,
            $saveFilename,
            $saveFileExtension
        );
    }

    /**
     * Returns full URL to file
     *
     * @param $serverFilePath - путь на сервере
     *
     * @return string
     */
    private function getFileUrl ( $serverFilePath )
    {
        return str_replace( '{{path}}', $serverFilePath, $this->apiFilesUrl );
    }
}