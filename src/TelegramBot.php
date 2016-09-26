<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 19:40
 */

namespace TelegramBotLibrary;

use TelegramBotLibrary\APIModels\ActionModels\_Selectors\ChatMemberSelector;
use TelegramBotLibrary\APIModels\ActionModels\_Selectors\ChatSelector;
use TelegramBotLibrary\APIModels\ActionModels\_Selectors\FileSelector;
use TelegramBotLibrary\APIModels\ActionModels\_Selectors\UserProfilePhotosSelector;
use TelegramBotLibrary\APIModels\ActionModels\Edit\EditMessageCaption;
use TelegramBotLibrary\APIModels\ActionModels\Edit\EditMessageReplyMarkup;
use TelegramBotLibrary\APIModels\ActionModels\Edit\EditMessageText;
use TelegramBotLibrary\APIModels\ActionModels\Forward\ForwardMessage;
use TelegramBotLibrary\APIModels\ActionModels\Send\SendAudio;
use TelegramBotLibrary\APIModels\ActionModels\Send\SendChatAction;
use TelegramBotLibrary\APIModels\ActionModels\Send\SendContact;
use TelegramBotLibrary\APIModels\ActionModels\Send\SendDocument;
use TelegramBotLibrary\APIModels\ActionModels\Send\SendLocation;
use TelegramBotLibrary\APIModels\ActionModels\Send\SendMessage;
use TelegramBotLibrary\APIModels\ActionModels\Send\SendPhoto;
use TelegramBotLibrary\APIModels\ActionModels\Send\SendVenue;
use TelegramBotLibrary\APIModels\ActionModels\Set\SetWebhook;
use TelegramBotLibrary\APIModels\BaseTypes\Chat;
use TelegramBotLibrary\APIModels\BaseTypes\ChatMember;
use TelegramBotLibrary\APIModels\BaseTypes\File;
use TelegramBotLibrary\APIModels\BaseTypes\Message;
use TelegramBotLibrary\APIModels\BaseTypes\Update;
use TelegramBotLibrary\APIModels\BaseTypes\User;
use TelegramBotLibrary\APIModels\BaseTypes\UserProfilePhotos;
use TelegramBotLibrary\APIModels\Constraints\IsIntegerMinMax;
use TelegramBotLibrary\APIModels\ModelsActions\SendEdit\SendSticker;
use TelegramBotLibrary\APIModels\ModelsActions\SendEdit\SendVideo;
use TelegramBotLibrary\APIModels\ModelsActions\SendEdit\SendVoice;
use TelegramBotLibrary\Exceptions\TelegramRuntimeException;

class TelegramBot
{
    protected $botToken;

    protected $botUser;

    protected $requester;

    protected $lastUpdateID = 0;

    /**
     * TelegramBot constructor.
     *
     * @param      $token - Токен бота
     * @param bool $skipPrevUpdates - пропустить предыдущие обновления, если они есть
     */
    public function __construct ( $token, $skipPrevUpdates = true )
    {
        $this->botToken = $token;
        $this->request = new APIRequester( $this );

        $this->botUser = $this->getMe();
        if ( $skipPrevUpdates ) $this->skipUpdates();
    }

    // <editor-fold defaultstate="collapsed" desc="Работа с обновлениями">

    /**
     * Возвращает информацию о боте в классе User
     *
     * @return User
     */
    public function getMe ()
    {
        if ( !$this->botUser ) {
            $getMeResult = $this->request->query( 'getMe' );
            $this->botUser = new User( $getMeResult );
        }

        return $this->botUser;
    }

    /**
     * Пропускает все предыдущие апдейты и записывает ID последнего
     *
     * @param null $specific_id
     */
    protected function skipUpdates ( $specific_id = null )
    {
        if ( $specific_id === null ) {
            $lastUpdate = $this->getUpdates( 1, -1 );
            $latestId = isset( $lastUpdate[ 0 ]->update_id ) ? $lastUpdate[ 0 ]->update_id : 0;
        } else {
            $latestId = $specific_id;
        }

        $this->getUpdates( 1, (int)$latestId + 1 );
        $this->lastUpdateID = $latestId;
    }

    /**
     * Вовзращает массив апдейтов, которые были посланы боту
     * Не работает если у бота установлен web-hook (возвращает пустой массив)
     *
     * @param int $limit - количество получаемых апдейтов от 1 до 100
     * @param int $offset - ID апдейта, начиная с которого получать
     *
     * @return Update[]
     */
    public function getUpdates ( $limit = 100, $offset = 0 )
    {
        $updates = $this->request->query( 'getUpdates', [ 'limit' => $limit, 'offset' => $offset ] );

        $updatesArray = [];
        if ( !empty( $updates ) ) {
            foreach ( $updates as $update ) $updatesArray[] = new Update( $update );

            $lastUpdate = new Update( end( $updates ) );
            $this->lastUpdateID = isset( $lastUpdate->update_id ) ? $lastUpdate->update_id : 0;
        }

        return $updatesArray;
    }

    // </editor-fold>

    // <editor-fold desc="Отправка данных">

    /**
     * Получает последние обновления, максимум 100
     *
     * @param int $limit - количество получаемых обновлений
     *
     * @return APIModels\BaseTypes\Update[]
     * @throws TelegramRuntimeException
     */
    public function getLastUpdates ( $limit = 100 )
    {
        $inMinMax = new IsIntegerMinMax( 1, 100 );
        if ( !$inMinMax->isValid( $limit ) ) {
            throw new TelegramRuntimeException( 'Parameter limit must be an ' . $inMinMax->getDescription() );
        }

        return $this->getUpdates( $limit, (int)$this->lastUpdateID + 1 );
    }

    /**
     * Отправляет сообщение
     *
     * @param SendMessage $message
     *
     * @return Message
     */
    public function sendMessage ( SendMessage $message )
    {
        $message->validateConstraints();
        $response = $this->request->query( 'sendMessage', $message->toQuery() );

        return new Message( $response );
    }

    /**
     * Переотправляет (цитирует) сообщение
     *
     * @param ForwardMessage $forwardMessage
     *
     * @return Message
     */
    public function forwardMessage ( ForwardMessage $forwardMessage )
    {
        $forwardMessage->validateConstraints();
        $response = $this->request->query( 'forwardMessage', $forwardMessage->toQuery() );

        return new Message( $response );
    }

    /**
     * Отправляет фото
     *
     * @param SendPhoto $photo
     *
     * @return Message
     */
    public function sendPhoto ( SendPhoto $photo )
    {
        $photo->validateConstraints();
        $response = $this->request->query( 'sendPhoto', $photo->toQuery() );

        return new Message( $response );
    }

    /**
     * Отправляет аудио файл
     *
     * @param SendAudio $audio
     *
     * @return Message
     */
    public function sendAudio ( SendAudio $audio )
    {
        $audio->validateConstraints();
        $response = $this->request->query( 'sendAudio', $audio->toQuery() );

        return new Message( $response );
    }

    /**
     * Отправляет документ
     *
     * @param SendDocument $document
     *
     * @return Message
     */
    public function sendDocument ( SendDocument $document )
    {
        $document->validateConstraints();
        $response = $this->request->query( 'sendDocument', $document->toQuery() );

        return new Message( $response );
    }

    /**
     * Отправляет стикер в формате .webm
     *
     * @param SendSticker $sticker
     *
     * @return Message
     */
    public function sendSticker ( SendSticker $sticker )
    {
        $sticker->validateConstraints();
        $response = $this->request->query( 'sendSticker', $sticker->toQuery() );

        return new Message( $response );
    }

    /**
     * Отправляет видео в формате .mp4
     *
     * @param SendVideo $video
     *
     * @return Message
     */
    public function sendVideo ( SendVideo $video )
    {
        $video->validateConstraints();
        $response = $this->request->query( 'sendVideo', $video->toQuery() );

        return new Message( $response );
    }

    /**
     * Отправляет голосовое сообщение в формате .ogg и кодеком OPUS
     *
     * @param SendVoice $voice
     *
     * @return Message
     */
    public function sendVoice ( SendVoice $voice )
    {
        $voice->validateConstraints();
        $response = $this->request->query( 'sendVoice', $voice->toQuery() );

        return new Message( $response );
    }

    /**
     * Отправляет геопозицию
     *
     * @param SendLocation $location
     *
     * @return Message
     */
    public function sendLocation ( SendLocation $location )
    {
        $location->validateConstraints();
        $response = $this->request->query( 'sendLocation', $location->toQuery() );

        return new Message( $response );
    }

    /**
     * Отправляет Venue - позицию с описанием и названием
     *
     * @param SendVenue $venue
     *
     * @return Message
     */
    public function sendVenue ( SendVenue $venue )
    {
        $venue->validateConstraints();
        $response = $this->request->query( 'sendVenue', $venue->toQuery() );

        return new Message( $response );
    }

    /**
     * Отправляет контакт
     *
     * @param SendContact $contact
     *
     * @return Message
     */
    public function sendContact ( SendContact $contact )
    {
        $contact->validateConstraints();
        $response = $this->request->query( 'sendContact', $contact->toQuery() );

        return new Message( $response );
    }

    // </editor-fold>

    // <editor-fold desc="Получение данных (исключая обновления)">

    /**
     * Отправляет в чат команду о том, что делает бот
     *
     * @param SendChatAction $chatAction
     *
     * @return bool
     */
    public function sendChatAction ( SendChatAction $chatAction )
    {
        $response = $this->request->query( 'sendChatAction', $chatAction->toQuery() );

        return $response;
    }

    /**
     * Получает фотографии профиля пользователя. Каждая фотография в 4-х размерах
     *
     * @param UserProfilePhotosSelector $getUserProfilePhotos
     *
     * @return UserProfilePhotos
     */
    public function getUserProfilePhotos ( UserProfilePhotosSelector $getUserProfilePhotos )
    {
        $getUserProfilePhotos->validateConstraints();
        $response = $this->request->query( 'getUserProfilePhotos', $getUserProfilePhotos->toQuery() );

        return new UserProfilePhotos( $response );
    }

    /**
     * Получает информацию о файле по его ID
     *
     * @param FileSelector $fileSelector
     *
     * @return File
     */
    public function getFile ( FileSelector $fileSelector )
    {
        $fileSelector->validateConstraints();
        $response = $this->request->query( 'getFile', $fileSelector->toQuery() );

        return new File( $response );
    }

    /**
     * Получает список администраторов чата
     *
     * @param ChatSelector $chatSelector
     *
     * @return ChatMember[]
     */
    public function getChatAdministrators ( ChatSelector $chatSelector )
    {
        $chatSelector->validateConstraints();
        $response = $this->request->query( 'getChatAdministrators', $chatSelector->toQuery() );

        $members = [];
        foreach ( $response as $member ) $members[] = new ChatMember( $member );

        return $members;
    }

    /**
     * Получает информацию о чате по ID
     *
     * @param ChatSelector $chatSelector
     *
     * @return Chat
     */
    public function getChat ( ChatSelector $chatSelector )
    {
        $chatSelector->validateConstraints();
        $response = $this->request->query( 'getChat', $chatSelector->toQuery() );

        return new Chat( $response );
    }

    /**
     * Вовзращает количество участников чата
     *
     * @param ChatSelector $chatSelector
     *
     * @return int
     */
    public function getChatMembersCount ( ChatSelector $chatSelector )
    {
        $chatSelector->validateConstraints();
        $response = $this->request->query( 'getChatMembersCount', $chatSelector->toQuery() );

        return $response;
    }

    /**
     * Возвращает информацию об участнике чата
     *
     * @param ChatMemberSelector $chatMemberSelector
     *
     * @return ChatMember
     */
    public function getChatMember ( ChatMemberSelector $chatMemberSelector )
    {
        $chatMemberSelector->validateConstraints();
        $response = $this->request->query( 'getChatMembersCount', $chatMemberSelector->toQuery() );

        return new ChatMember( $response );
    }

    // </editor-fold>

    // <editor-fold desc="Другие действия">

    /**
     * Устанавливает WebHook
     *
     * @param SetWebhook $webhook
     *
     * @return array
     */
    public function setWebhook ( SetWebhook $webhook )
    {
        $webhook->validateConstraints();
        $response = $this->request->query( 'setWebhook', $webhook->toQuery( true ), true );

        return $response;
    }

    /**
     * Кикает участника группы
     *
     * @param ChatMemberSelector $chatMemberSelector
     *
     * @return array
     */
    public function kickChatMember ( ChatMemberSelector $chatMemberSelector )
    {
        $chatMemberSelector->validateConstraints();
        $response = $this->request->query( 'kickChatMember', $chatMemberSelector->toQuery() );

        return $response;
    }

    /**
     * Заставляет бота покинуть группу
     *
     * @param ChatSelector $chatSelector
     *
     * @return array
     */
    public function leaveChat ( ChatSelector $chatSelector )
    {
        $chatSelector->validateConstraints();
        $response = $this->request->query( 'leaveChat', $chatSelector->toQuery() );

        return $response;
    }

    /**
     * Разбанивает участнигра группы
     *
     * @param ChatMemberSelector $chatMemberSelector
     *
     * @return array
     */
    public function unbanChatMember ( ChatMemberSelector $chatMemberSelector )
    {
        $chatMemberSelector->validateConstraints();
        $response = $this->request->query( 'unbanChatMember', $chatMemberSelector->toQuery() );

        return $response;
    }

    /**
     * Редактирует текст сообщения
     *
     * @param EditMessageText $editMessageText
     *
     * @return array
     */
    public function editMessageText ( EditMessageText $editMessageText )
    {
        $editMessageText->validateConstraints();
        $response = $this->request->query( 'editMessageText', $editMessageText->toQuery() );

        return $response;
    }

    /**
     * Редактирует описание сообщения
     *
     * @param EditMessageCaption $editMessageCaption
     *
     * @return array
     */
    public function editMessageCaption ( EditMessageCaption $editMessageCaption )
    {
        $editMessageCaption->validateConstraints();
        $response = $this->request->query( 'editMessageCaption', $editMessageCaption->toQuery() );

        return $response;
    }

    /**
     * Редактирует клавиатуру сообщения
     *
     * @param EditMessageReplyMarkup $editMessageReplyMarkup
     *
     * @return array
     */
    public function editMessageReplyMarkup ( EditMessageReplyMarkup $editMessageReplyMarkup )
    {
        $editMessageReplyMarkup->validateConstraints();
        $response = $this->request->query( 'editMessageReplyMarkup', $editMessageReplyMarkup->toQuery() );

        return $response;
    }

    // </editor-fold>

    // TODO: Inline mode

    /**
     * Получить токен бота
     *
     * @return string
     */
    public function getBotToken ()
    {
        return $this->botToken;
    }

    /**
     * Получить ID последнего полученного апдейта
     *
     * @return int
     */
    public function getLastUpdateID ()
    {
        return $this->lastUpdateID;
    }

    /**
     * Скачивает файл
     *
     * @param             $serverPath - путь на сервере
     * @param             $saveDir - папка сохранения
     * @param null|string $saveName = имя файла для сохранения
     * @param null|bool $hashedName = захешировать имя и контент файла
     *
     * @return string
     */
    public function downloadFile ( $serverPath, $saveDir, $saveName = null, $hashedName = true )
    {
        return $this->request->downloadTelegramFile( $serverPath, $saveDir, $saveName, $hashedName );
    }

}