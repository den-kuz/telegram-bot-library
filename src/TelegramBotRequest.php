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
    private $API_URL;
    private $bot;

    /**
     * TeleBotRequest constructor.
     * @param TelegramBot $bot
     */
    public function __construct(TelegramBot $bot) {
        $this->bot = $bot;
    }

    /**
     * @param $method
     * @return mixed
     */
    private function getAPIUrlByMethod($method) {
        if( empty($this->API_URL) ) {
            $this->API_URL = str_replace('{token}', $this->bot->getBotToken(), self::TELEGRAM_API_URL_TEMPLATE);
        }

        return str_replace('{method}', $method, $this->API_URL);
    }

    /**
     * @param $method
     * @param null $parameters
     * @return array
     * @throws TelegramBotException
     */
    public function query($method, $parameters = null) {
        $postFields = is_array($parameters);
        
        if($postFields) {
            $contentType = 'multipart/form-data';
        } else {
            $contentType = 'application/json';
        }

        $curlDescriptor = curl_init( $this->getAPIUrlByMethod($method) );
        curl_setopt_array(
            $curlDescriptor,
            [
                CURLOPT_POST => true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => ['Content-Type: ' . $contentType]
            ]
        );

        if ( $postFields ) {
            curl_setopt($curlDescriptor, CURLOPT_POSTFIELDS, $parameters);
        }

        $apiResponse = curl_exec($curlDescriptor);
        $apiResponse = json_decode($apiResponse, true);
        curl_close($curlDescriptor);

        if( !isset($apiResponse['ok']) ) {
            throw new TelegramBotException( 'Данные не получены', 1000 );
        } elseif ( $apiResponse['ok'] == false ) {
            throw new TelegramBotException( $apiResponse['description'], $apiResponse['error_code'] );
        } elseif ( ($apiResponse['ok'] == true) && (isset($apiResponse['result'])) ) {
            return $apiResponse['result'];
        }

        return [];
    }

    /**
     *
     */
    public function __destruct() {
        unset($this->bot);
    }
}