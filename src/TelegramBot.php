<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 19:40
 */

namespace TelegramBotLibrary;

use TelegramBotLibrary\APIModels\BaseTypes\Chat;
use TelegramBotLibrary\APIModels\BaseTypes\ChatMember;
use TelegramBotLibrary\APIModels\BaseTypes\Update;
use TelegramBotLibrary\APIModels\BaseTypes\User;
use TelegramBotLibrary\APIModels\BaseTypes\UserProfilePhotos;
use TelegramBotLibrary\APIModels\GetModels\GetUserProfilePhotos;
use TelegramBotLibrary\APIModels\SendModels\SendAudio;
use TelegramBotLibrary\APIModels\SendModels\SendContact;
use TelegramBotLibrary\APIModels\SendModels\SendDocument;
use TelegramBotLibrary\APIModels\SendModels\SendForwardMessage;
use TelegramBotLibrary\APIModels\SendModels\SendLocation;
use TelegramBotLibrary\APIModels\SendModels\SendMesssage;
use TelegramBotLibrary\APIModels\SendModels\SendPhoto;
use TelegramBotLibrary\APIModels\SendModels\SendSticker;
use TelegramBotLibrary\APIModels\SendModels\SendVenue;
use TelegramBotLibrary\APIModels\SendModels\SendVideo;
use TelegramBotLibrary\APIModels\SendModels\SendVoice;
use TelegramBotLibrary\Exceptions\TelegramBotException;

class TelegramBot
{
    private $botToken;
    private $botUser;
    private $lastUpdateID = 0;
    private $request;

    /**
     * TelegramBot constructor.
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

    // <editor-fold defaultstate="collapsed" desc="Работа с обновлениями">

    /**
     * Получает апдейты, которые были посланы боту
     *
     * @param int $limit - количество получаемых апдейтов от 1 до 100
     * @param int $offset - ID апдейта, начиная с которого получать
     * @return array|Update[]
     * @throws TelegramBotException
     */
    public function getUpdates($limit = 100, $offset = 0)
    {
        $updates = $this->request->query('getUpdates', [ 'limit'  => $limit, 'offset' => $offset ]);

        $updatesArray = [];
        if ( !empty($updates) ) {
            foreach ($updates as $update) $updatesArray[] = new Update($update);

            $lastUpdate = new Update( end($updates) );
            $this->lastUpdateID = isset($lastUpdate->update_id) ? $lastUpdate->update_id : 0;
        }

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
     * @return array|Update[]
     */
    public function getLastUpdates($limit = 100)
    {
        return $this->getUpdates($limit, (int)$this->lastUpdateID + 1);
    }

    // </editor-fold>
    // <editor-fold desc="Отправка данных">

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

    public function sendChatAction($chat_id, $action) {
        $this->request->query('sendChatAction', [ 'chat_id' => $chat_id, 'action' => $action ]);
    }
    // </editor-fold>
    // <editor-fold desc="Получение данных (исключая обновления)">

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
            $this->botUser = new User( $getMeResult );
        }
        return $this->botUser;
    }

    /**
     * Получает фотографии профиля пользователя. Каждая фотография в 4-х размерах
     * 
     * @param $user_id
     * @param null $offset
     * @param null $limit
     * @throws TelegramBotException
     * @return UserProfilePhotos
     */
    public function getUserProfilePhotos($user_id, $offset = null, $limit = null) {
        $GetUserPhoto = new GetUserProfilePhotos([ 'user_id' => $user_id, 'offset' => $offset, 'limit' => $limit ]);
        $response = $this->request->query('getUserProfilePhotos', $GetUserPhoto->convertToQuery());

        return new UserProfilePhotos($response);
    }

    public function getChatAdministrators($chat_id) {
        $response = $this->request->query( 'getChatAdministrators', ['chat_id' => $chat_id] );

        $members = [];
        foreach ($response as $member) $members[] = new ChatMember($member);
        return $members;
    }

    public function getChat($chat_id) {
        $response = $this->request->query( 'getChat', ['chat_id' => $chat_id] );

        return new Chat($response);
    }

    public function getChatMembersCount($chat_id) {
        $response = $this->request->query( 'getChatMembersCount', ['chat_id' => $chat_id] );

        return $response;
    }

    public function getChatMember($chat_id, $user_id) {
        $response = $this->request->query( 'getChatMembersCount', ['chat_id' => $chat_id, 'user_id' => $user_id] );

        return new ChatMember($response);
    }
    // </editor-fold>
    
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