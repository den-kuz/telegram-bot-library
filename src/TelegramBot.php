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
use TelegramBotLibrary\APIModels\BaseTypes\File;
use TelegramBotLibrary\APIModels\BaseTypes\Message;
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
use TelegramBotLibrary\APIModels\SendModels\SendWebhook;
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
     * @return Update[]
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
     * @return Update[]
     */
    public function getLastUpdates($limit = 100)
    {
        return $this->getUpdates($limit, (int)$this->lastUpdateID + 1);
    }

    // </editor-fold>

    // <editor-fold desc="Отправка данных">

    /**
     * Отправляет сообщение
     *
     * @param SendMesssage $message
     * @return Message
     * @throws TelegramBotException
     */
    public function sendMessage(SendMesssage $message)
    {
        $response = $this->request->query('sendMessage', $message->convertToQuery());

        return new Message($response);
    }

    /**
     * Переотправляет (цитирует) сообщение
     *
     * @param SendForwardMessage $forwardMessageModel
     * @return Message
     * @throws TelegramBotException
     */
    public function forwardMessage(SendForwardMessage $forwardMessageModel) {
        $response = $this->request->query('forwardMessage', $forwardMessageModel->convertToQuery());
        return new Message($response);
    }

    /**
     * Отправляет фото
     *
     * @param SendPhoto $photo
     * @return Message
     * @throws TelegramBotException
     */
    public function sendPhoto(SendPhoto $photo)
    {
        $response =$this->request->query('sendPhoto', $photo->convertToQuery());
        return new Message($response);
    }

    /**
     * Отправляет аудио файл
     *
     * @param SendAudio $audio
     * @return Message
     * @throws TelegramBotException
     */
    public function sendAudio(SendAudio $audio) {
        $response = $this->request->query('sendAudio', $audio->convertToQuery());

        return new Message($response);
    }

    /**
     * Отправляет документ
     *
     * @param SendDocument $document
     * @return Message
     * @throws TelegramBotException
     */
    public function sendDocument(SendDocument $document)
    {
        $response = $this->request->query('sendDocument', $document->convertToQuery());

        return new Message($response);
    }

    /**
     * Отправляет стикер в формате .webm
     *
     * @param SendSticker $sticker
     * @return Message
     * @throws TelegramBotException
     */
    public function sendSticker(SendSticker $sticker) {
        $response = $this->request->query('sendSticker', $sticker->convertToQuery());

        return new Message($response);
    }

    /**
     * Отправляет видео в формате .mp4
     *
     * @param SendVideo $video
     * @return Message
     * @throws TelegramBotException
     */
    public function sendVideo(SendVideo $video) {
        $response = $this->request->query('sendVideo', $video->convertToQuery());

        return new Message($response);
    }

    /**
     * Отправляет голосовое сообщение в формате .ogg и кодеком OPUS
     *
     * @param SendVoice $voice
     * @return Message
     * @throws TelegramBotException
     */
    public function sendVoice(SendVoice $voice) {
        $response = $this->request->query('sendVoice', $voice->convertToQuery());

        return new Message($response);
    }

    /**
     * Отправить позицию
     *
     * @param SendLocation $location
     * @return Message
     * @throws TelegramBotException
     */
    public function sendLocation(SendLocation $location) {
        $response = $this->request->query('sendLocation', $location->convertToQuery());

        return new Message($response);
    }

    /**
     * Отправить веню - позицию с описанием и названием
     *
     * @param SendVenue $venue
     * @return Message
     * @throws TelegramBotException
     */
    public function sendVenue(SendVenue $venue) {
        $response = $this->request->query('sendVenue', $venue->convertToQuery());

        return new Message($response);
    }

    /**
     * Отправляет контакт
     *
     * @param SendContact $contact
     * @return Message
     * @throws TelegramBotException
     */
    public function sendContact(SendContact $contact) {
        $response = $this->request->query('sendContact', $contact->convertToQuery());

        return new Message($response);
    }

    /**
     * Отправляет в чат команду о том, что делает бот
     *
     * @param $chat_id
     * @param $action
     * @return bool
     * @throws TelegramBotException
     */
    public function sendChatAction($chat_id, $action) {
        $response = $this->request->query('sendChatAction', [ 'chat_id' => $chat_id, 'action' => $action ]);
        
        return $response;
    }
    // </editor-fold>

    // <editor-fold desc="Получение данных (исключая обновления)">

    /**
     * Возвращает информацию о боте в классе User
     *
     * @return User
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

    /**
     * Получает информацию о файле по его ID
     *
     * @param $file_id
     * @return File
     * @throws TelegramBotException
     */
    public function getFile($file_id) {
        $response = $this->request->query( 'getFile', ['file_id' => $file_id] );

        return new File($response);
    }

    /**
     * Получает список администраторов чата
     *
     * @param $chat_id
     * @return ChatMember[]
     * @throws TelegramBotException
     */
    public function getChatAdministrators($chat_id) {
        $response = $this->request->query( 'getChatAdministrators', ['chat_id' => $chat_id] );

        $members = [];
        foreach ($response as $member) $members[] = new ChatMember($member);
        return $members;
    }

    /**
     * Получает информацию о чате по ID
     *
     * @param $chat_id - ID чата
     * @return Chat
     * @throws TelegramBotException
     */
    public function getChat($chat_id) {
        $response = $this->request->query( 'getChat', ['chat_id' => $chat_id] );

        return new Chat($response);
    }

    /**
     * Вовзращает количество участников чата
     *
     * @param $chat_id - ID чата
     * @return int
     * @throws TelegramBotException
     */
    public function getChatMembersCount($chat_id) {
        $response = $this->request->query( 'getChatMembersCount', ['chat_id' => $chat_id] );

        return $response;
    }

    /**
     * Возвращает информацию об участнике чата по ID
     *
     * @param $chat_id - ID чата
     * @param $user_id - ID юзера
     * @return ChatMember
     * @throws TelegramBotException
     */
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

    /**
     * Скачивает файл
     * 
     * @param $serverPath - путь на сервере
     * @param $saveDir - папка сохранения
     * @param null|string $saveName = имя файла для сохранения
     * @param null|bool $hashedName = захешировать имя и контент файла
     * 
     * @return string
     */
    public function downloadFile($serverPath, $saveDir, $saveName = null, $hashedName = true) {
        return $this->request->downloadTelegramFile($serverPath, $saveDir, $saveName, $hashedName);
    }

    /**
     * Устанавливает WebHook 
     * 
     * @param SendWebhook $webhook
     * @throws TelegramBotException
     */
    public function setWebhook(SendWebhook $webhook) {
        $response = $this->request->query('setWebhook', $webhook->convertToQuery());
    }
}