<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 19:51
 */

namespace TelegramBotLibrary;


use TelegramBotLibrary\Exceptions\TelegramBotException;

class TelegramBotRequest
{
    const TELEGRAM_API_URL_TEMPLATE = 'https://api.telegram.org/bot{token}/{method}';
    const TELEGRAM_FILE_URL_TEMPLATE = 'https://api.telegram.org/file/bot{token}/{path}';

    private $API_URL;
    private $FILE_URL;
    private $bot;

    /**
     * TeleBotRequest constructor.
     * @param TelegramBot $bot
     */
    public function __construct(TelegramBot $bot) {
        $this->bot = $bot;

        $this->API_URL = str_replace('{token}', $this->bot->getBotToken(), self::TELEGRAM_API_URL_TEMPLATE);
        $this->FILE_URL = str_replace('{token}', $this->bot->getBotToken(), self::TELEGRAM_FILE_URL_TEMPLATE);
    }

    /**
     * @param $method
     * @return string
     */
    private function getAPIUrlByMethod($method) {
        return str_replace('{method}', $method, $this->API_URL);
    }


    /**
     * @param $path
     * @return string
     */
    private function getFileUrlByPath($path) {
        return str_replace('{path}', $path, $this->FILE_URL);
    }

    /**
     * @param $method
     * @param null $parameters
     * @return array
     * @throws TelegramBotException
     */
    public function query($method, $parameters = null) {
        $postFields = is_array($parameters);
        $contentType = $postFields ? 'multipart/form-data' : 'application/json';

        $curlDescriptor = curl_init( $this->getAPIUrlByMethod($method) );
        curl_setopt_array(
            $curlDescriptor,
            [
                CURLOPT_POST => true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => ['Content-Type: ' . $contentType]
            ]
        );

        if ( $postFields ) curl_setopt($curlDescriptor, CURLOPT_POSTFIELDS, $parameters);

        $apiResponse = curl_exec($curlDescriptor);
        $apiResponse = json_decode($apiResponse, true);
        curl_close($curlDescriptor);

        if( !isset( $apiResponse['ok'] ) ) {
            throw new TelegramBotException( 'Данные не получены', 1000 );
        } elseif ( $apiResponse['ok'] == false ) {
            throw new TelegramBotException( $apiResponse['description'], $apiResponse['error_code'] );
        } elseif ( ($apiResponse['ok'] == true) && (isset($apiResponse['result'])) ) {
            return $apiResponse['result'];
        }

        return [];
    }

    public function downloadTelegramFile($file_path, $save_dir, $save_name)
    {
        $url = $this->getFileUrlByPath($file_path);
        
        return static::download($url, $save_dir, $save_name);
    }

    private static function download($link, $path = './', $name = null) {
        $curlDescriptor = curl_init($link);
        curl_setopt_array(
            $curlDescriptor,
            [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER => 0,
            ]
        );

        $fileContent = curl_exec($curlDescriptor);
        
        if( !is_string($name) || empty($name) ) $name = md5($link);
        $path = realpath($path);

        file_put_contents($path . '/' . $name, $fileContent);
        
        return $path . '/' . $name;
    }

    /**
     *
     */
    public function __destruct() {
        unset($this->bot);
    }
}