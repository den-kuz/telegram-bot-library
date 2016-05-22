<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 19:40
 */

namespace TelegramBotLibrary;

use TelegramBotLibrary\APIModels\BaseTypes\Update;
use TelegramBotLibrary\APIModels\BaseTypes\User;
use TelegramBotLibrary\APIModels\SendTypes\SendAudio;
use TelegramBotLibrary\APIModels\SendTypes\SendContact;
use TelegramBotLibrary\APIModels\SendTypes\SendDocument;
use TelegramBotLibrary\APIModels\SendTypes\SendForwardMessage;
use TelegramBotLibrary\APIModels\SendTypes\SendLocation;
use TelegramBotLibrary\APIModels\SendTypes\SendMesssage;
use TelegramBotLibrary\APIModels\SendTypes\SendPhoto;
use TelegramBotLibrary\APIModels\SendTypes\SendSticker;
use TelegramBotLibrary\APIModels\SendTypes\SendVenue;
use TelegramBotLibrary\APIModels\SendTypes\SendVideo;
use TelegramBotLibrary\APIModels\SendTypes\SendVoice;
use TelegramBotLibrary\Exceptions\TelegramBotException;

class TelegramBot
{
    private $botToken;
    private $botUser;
    private $lastUpdateID = 0;
    private $request;

    /**
     * TeleBot constructor.
     *
     * @param $token - Токен бота
     * @param bool $skipPrevUpdates - пропустить предыдущие обновления, если они есть
     */
    public function __construct($token, $skipPrevUpdates = true)
    {
        $this->botToken = $token;
        $this->request = new TelegramBotRequest($this);

        $this->botUser = $this->getMe();
        if ($skipPrevUpdates) $this->skipUpdates();
    }

    /**
     * Возвращает информацию о боте в классе User
     *
     * @return mixed|User
     * @throws TelegramBotException
     */
    public function getMe()
    {
        if (!$this->botUser) {
            $getMeResult = $this->request->query('getMe');
            $this->botUser = new User($getMeResult);
        }
        return $this->botUser;
    }

    /**
     * Получает апдейты, которые были посланы боту
     *
     * @param int $limit - количество получаемых апдейтов от 1 до 100
     * @param int $offset - ID апдейта, начиная с которого получать
     * @return array
     * @throws TelegramBotException
     */
    public function getUpdates($limit = 100, $offset = 0)
    {
        $params = [
            'limit'  => $limit,
            'offset' => $offset
        ];

        $updates = $this->request->query('getUpdates', $params);

        if (!empty($updates)) {
            $lastUpdate = new Update(end($updates));
            $this->lastUpdateID = isset($lastUpdate->update_id) ? $lastUpdate->update_id : 0;
        }

        $updatesArray = [];
        foreach ($updates as $update) $updatesArray[] = new Update($update);

        return $updatesArray;
    }


    /**
     * Пропускает все предыдущие апдейты и записывает ID последнего
     *
     * @param null $specific_id
     */
    protected function skipUpdates($specific_id = null)
    {
        if ($specific_id === null) {
            $lastUpdate = $this->getUpdates(1, -1);
            $latestId = isset($lastUpdate[0]->update_id) ? $lastUpdate[0]->update_id : 0;
        } else {
            $latestId = $specific_id;
        }

        $this->getUpdates(1, (int)$latestId + 1);
        $this->lastUpdateID = $latestId;
    }

    /**
     * Получает последние обновления
     *
     * @param int $limit - количество получаемых обновлений
     * @return array
     */
    public function getLastUpdates($limit = 100)
    {
        return $this->getUpdates($limit, (int)$this->lastUpdateID + 1);
    }

    /**
     * Отправляет сообщения
     *
     * @param SendMesssage $message
     * @throws TelegramBotException
     */
    public function sendMessage(SendMesssage $message)
    {
        $this->request->query('sendMessage', $message->convertToQuery());
    }

    /**
     * Переотправляет (цитирует) сообщение
     *
     * @param SendForwardMessage $forwardMessageModel
     * @throws TelegramBotException
     */
    public function forwardMessage(SendForwardMessage $forwardMessageModel) {
        $this->request->query('forwardMessage', $forwardMessageModel->convertToQuery());
    }

    /**
     * Отправляет фото
     *
     * @param SendPhoto $photo
     * @throws TelegramBotException
     */
    public function sendPhoto(SendPhoto $photo)
    {
        $this->request->query('sendPhoto', $photo->convertToQuery());
    }

    /**
     * Отправляет аудио файл
     *
     * @param SendAudio $audio
     * @throws TelegramBotException
     */
    public function sendAudio(SendAudio $audio) {
        $this->request->query('sendAudio', $audio->convertToQuery());
    }

    /**
     * Отправляет документ
     *
     * @param SendDocument $document
     * @throws TelegramBotException
     */
    public function sendDocument(SendDocument $document)
    {
        $this->request->query('sendDocument', $document->convertToQuery());
    }

    /**
     * Отправляет стикер в формате .webm
     *
     * @param SendSticker $sticker
     * @throws TelegramBotException
     */
    public function sendSticker(SendSticker $sticker) {
        $this->request->query('sendSticker', $sticker->convertToQuery());
    }

    /**
     * Отправляет видео в формате .mp4
     *
     * @param SendVideo $video
     * @throws TelegramBotException
     */
    public function sendVideo(SendVideo $video) {
        $this->request->query('sendVideo', $video->convertToQuery());
    }

    /**
     * Отправляет голосовое сообщение в формате .ogg и кодеком OPUS
     *
     * @param SendVoice $voice
     * @throws TelegramBotException
     */
    public function sendVoice(SendVoice $voice) {
        $this->request->query('sendVoice', $voice->convertToQuery());
    }

    /**
     * Отправить позицию
     *
     * @param SendLocation $location
     * @throws TelegramBotException
     */
    public function sendLocation(SendLocation $location) {
        $this->request->query('sendLocation', $location->convertToQuery());
    }

    /**
     * Отправить веню - позицию с описанием и названием
     *
     * @param SendVenue $venue
     * @throws TelegramBotException
     */
    public function sendVenue(SendVenue $venue) {
        $this->request->query('sendVenue', $venue->convertToQuery());
    }

    /**
     * Отправляет контакт
     *
     * @param SendContact $contact
     * @throws TelegramBotException
     */
    public function sendContact(SendContact $contact) {
        $this->request->query('sendContact', $contact->convertToQuery());
    }

    /**
     * Получить токен бота
     *
     * @return string
     */
    public function getBotToken()
    {
        return $this->botToken;
    }

    /**
     * Получить ID последнего полученного апдейта
     *
     * @return int
     */
    public function getLastUpdateID()
    {
        return $this->lastUpdateID;
    }
}