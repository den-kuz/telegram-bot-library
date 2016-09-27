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
     * @param string $token : Bot token
     * @param bool $skipPrevUpdates : If true, skips previous incoming updates
     */
    public function __construct ( $token, $skipPrevUpdates = true )
    {
        $this->botToken = $token;
        $this->requester = new APIRequest( $token );

        $this->botUser = $this->getMe();
        if ( $skipPrevUpdates ) $this->skipUpdates();
    }

    /**
     * Get information about the bot
     *
     * A simple method for testing your bot's auth token
     * Requires no parameters. Returns basic information about the bot in form of a "User" object
     *
     * @param bool $forceUpdate : Force update information about the bot.
     *
     * @return User
     */
    public function getMe ( $forceUpdate = false )
    {
        if ( !$this->botUser || $forceUpdate ) {
            $this->botUser = new User( $this->requester->query( 'getMe' ) );
        }

        return $this->botUser;
    }

    /**
     * Skip previous incoming updates
     *
     * This method skips all previous incoming updates and saves last update ID in field "lastUpdateID"
     * If parameter "$specific_id" specified - method skips previous updates before this ID
     *
     * @param integer $specific_id
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
     * Get incoming updates
     *
     * Use this method to receive incoming updates.
     * An Array of objects of class "Update" is returned.
     *
     * @param integer $limit : Limits the number of updates to be retrieved. Values between 1-100 are accepted. Defaults to 100.
     * @param integer $offset : Identifier of the first update to be returned. Must be greater by one than the highest among the identifiers of previously received updates
     *
     * @return Update[]
     * @throws TelegramRuntimeException
     */
    public function getUpdates ( $limit = 100, $offset = 0 )
    {
        $inMinMax = new IsIntegerMinMax( 1, 100 );
        if ( !$inMinMax->isValid( $limit ) ) {
            throw new TelegramRuntimeException( 'Parameter limit must be an ' . $inMinMax->getDescription() );
        }

        $updates = $this->requester->query( 'getUpdates', [ 'limit' => $limit, 'offset' => $offset ] );

        $updatesArray = [];
        if ( !empty( $updates ) ) {
            foreach ( $updates as $update ) $updatesArray[] = new Update( $update );

            $lastUpdate = new Update( end( $updates ) );
            $this->lastUpdateID = isset( $lastUpdate->update_id ) ? $lastUpdate->update_id : 0;
        }

        return $updatesArray;
    }

    // <editor-fold defaultstate="collapsed" desc="Getting updates">

    /**
     * Get bot token
     *
     * @return string
     */
    public function getBotToken ()
    {
        return $this->botToken;
    }

    /**
     * Get last received update ID
     *
     * @return int
     */
    public function getLastUpdateID ()
    {
        return $this->lastUpdateID;
    }

    /**
     * Get last incomig updates
     *
     * @param integer $limit : Limits the number of updates to be retrieved. Values between 1-100 are accepted. Defaults to 100.
     *
     * @return Update[]
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

    // </editor-fold>

    // <editor-fold desc="Getting data (excluding updates)">

    /**
     * Get user profiles photos
     *
     * Use this method to get a list of profile pictures for a user.
     * Returns a UserProfilePhotos object.
     *
     * @param UserProfilePhotosSelector $getUserProfilePhotos
     *
     * @return UserProfilePhotos
     */
    public function getUserProfilePhotos ( UserProfilePhotosSelector $getUserProfilePhotos )
    {
        $getUserProfilePhotos->validateConstraints();
        $response = $this->requester->query( 'getUserProfilePhotos', $getUserProfilePhotos->toQuery() );

        return new UserProfilePhotos( $response );
    }

    /**
     * Get file
     *
     * Use this method to get basic info about a file and prepare it for downloading.
     * For the moment, bots can download files of up to 20MB in size.
     * The file can then be downloaded via the link https://api.telegram.org/file/bot<token>/<file_path>,
     * where <file_path> is taken from the response. It is guaranteed that the link will be valid for at least 1 hour.
     * When the link expires, a new one can be requested by calling getFile again.
     *
     * On success, a "File" object is returned.
     *
     * @param FileSelector $fileSelector
     *
     * @return File
     */
    public function getFile ( FileSelector $fileSelector )
    {
        $fileSelector->validateConstraints();
        $response = $this->requester->query( 'getFile', $fileSelector->toQuery() );

        return new File( $response );
    }

    /**
     * Get chat administrators
     *
     * Use this method to get a list of administrators in a chat.
     * On success, returns an Array of "ChatMember" objects that contains information about all chat administrators except other bots.
     * If the chat is a group or a supergroup and no administrators were appointed, only the creator will be returned.
     *
     * @param ChatSelector $chatSelector
     *
     * @return ChatMember[]
     */
    public function getChatAdministrators ( ChatSelector $chatSelector )
    {
        $chatSelector->validateConstraints();
        $response = $this->requester->query( 'getChatAdministrators', $chatSelector->toQuery() );

        $members = [];
        foreach ( $response as $member ) $members[] = new ChatMember( $member );

        return $members;
    }

    /**
     * Get chat
     *
     * Use this method to get up to date information about the chat
     * (current name of the user for one-on-one conversations, current username of a user, group or channel, etc.).
     *
     * Returns a "Chat" object on success.
     *
     * @param ChatSelector $chatSelector
     *
     * @return Chat
     */
    public function getChat ( ChatSelector $chatSelector )
    {
        $chatSelector->validateConstraints();
        $response = $this->requester->query( 'getChat', $chatSelector->toQuery() );

        return new Chat( $response );
    }

    /**
     * Get chat members count
     *
     * Use this method to get the number of members in a chat. Returns Int on success.
     *
     * @param ChatSelector $chatSelector
     *
     * @return int
     */
    public function getChatMembersCount ( ChatSelector $chatSelector )
    {
        $chatSelector->validateConstraints();
        $response = $this->requester->query( 'getChatMembersCount', $chatSelector->toQuery() );

        return $response;
    }

    /**
     * Get chat member
     *
     * Use this method to get information about a member of a chat.
     * Returns a "ChatMember" object on success.
     *
     * @param ChatMemberSelector $chatMemberSelector
     *
     * @return ChatMember
     */
    public function getChatMember ( ChatMemberSelector $chatMemberSelector )
    {
        $chatMemberSelector->validateConstraints();
        $response = $this->requester->query( 'getChatMembersCount', $chatMemberSelector->toQuery() );

        return new ChatMember( $response );
    }

    // </editor-fold>

    // <editor-fold desc="Sending data">

    /**
     * Send text message
     *
     * Use this method to send text message.
     *
     * On success, the sent message is returned as object of class "Message"
     *
     * @param SendMessage $message
     *
     * @return Message
     */
    public function sendMessage ( SendMessage $message )
    {
        $message->validateConstraints();
        $response = $this->requester->query( 'sendMessage', $message->toQuery() );

        return new Message( $response );
    }

    /**
     * Forvard message
     *
     * Use this method to forward messages of any kind.
     *
     * On success, the sent message is returned as object of class "Message"
     *
     * @param ForwardMessage $forwardMessage
     *
     * @return Message
     */
    public function forwardMessage ( ForwardMessage $forwardMessage )
    {
        $forwardMessage->validateConstraints();
        $response = $this->requester->query( 'forwardMessage', $forwardMessage->toQuery() );

        return new Message( $response );
    }

    /**
     * Send photo
     *
     * Use this method to send photos.
     *
     * On success, the sent message is returned as object of class "Message"
     *
     * @param SendPhoto $photo
     *
     * @return Message
     */
    public function sendPhoto ( SendPhoto $photo )
    {
        $photo->validateConstraints();
        $response = $this->requester->query( 'sendPhoto', $photo->toQuery() );

        return new Message( $response );
    }

    /**
     * Send audio
     *
     * Use this method to send audio files, if you want Telegram clients to display them in the music player.
     * Your audio must be in the .mp3 format. Bots can currently send audio files of up to 50 MB in size,
     * this limit may be changed in the future.
     *
     * On success, the sent message is returned as object of class "Message"
     *
     * @param SendAudio $audio
     *
     * @return Message
     */
    public function sendAudio ( SendAudio $audio )
    {
        $audio->validateConstraints();
        $response = $this->requester->query( 'sendAudio', $audio->toQuery() );

        return new Message( $response );
    }

    /**
     * Send document
     *
     * Use this method to send general files.
     * Bots can currently send files of any type of up to 50 MB in size, this limit may be changed in the future.
     *
     * On success, the sent message is returned as object of class "Message"
     *
     * @param SendDocument $document
     *
     * @return Message
     */
    public function sendDocument ( SendDocument $document )
    {
        $document->validateConstraints();
        $response = $this->requester->query( 'sendDocument', $document->toQuery() );

        return new Message( $response );
    }

    /**
     * Send sticker
     *
     * Use this method to send .webp stickers.
     *
     * On success, the sent message is returned as object of class "Message"
     *
     * @param SendSticker $sticker
     *
     * @return Message
     */
    public function sendSticker ( SendSticker $sticker )
    {
        $sticker->validateConstraints();
        $response = $this->requester->query( 'sendSticker', $sticker->toQuery() );

        return new Message( $response );
    }

    /**
     * Send video
     *
     * Use this method to send video files, Telegram clients support mp4 videos (other formats may be sent as Document).
     * Bots can currently send video files of up to 50 MB in size, this limit may be changed in the future.
     *
     * On success, the sent message is returned as object of class "Message"
     *
     * @param SendVideo $video
     *
     * @return Message
     */
    public function sendVideo ( SendVideo $video )
    {
        $video->validateConstraints();
        $response = $this->requester->query( 'sendVideo', $video->toQuery() );

        return new Message( $response );
    }

    /**
     * Send voice message
     *
     * Use this method to send audio files, if you want Telegram clients to display the file as a playable voice message.
     * For this to work, your audio must be in an .ogg file encoded with OPUS (other formats may be sent as Audio or Document).
     * Bots can currently send voice messages of up to 50 MB in size, this limit may be changed in the future.
     *
     * On success, the sent message is returned as object of class "Message"
     *
     * @param SendVoice $voice
     *
     * @return Message
     */
    public function sendVoice ( SendVoice $voice )
    {
        $voice->validateConstraints();
        $response = $this->requester->query( 'sendVoice', $voice->toQuery() );

        return new Message( $response );
    }

    /**
     * Send location
     *
     * Use this method to send point on the map.
     *
     * On success, the sent message is returned as object of class "Message"
     *
     * @param SendLocation $location
     *
     * @return Message
     */
    public function sendLocation ( SendLocation $location )
    {
        $location->validateConstraints();
        $response = $this->requester->query( 'sendLocation', $location->toQuery() );

        return new Message( $response );
    }

    /**
     * Send venue
     *
     * Use this method to send information about a venue.
     *
     * On success, the sent message is returned as object of class "Message"
     *
     * @param SendVenue $venue
     *
     * @return Message
     */
    public function sendVenue ( SendVenue $venue )
    {
        $venue->validateConstraints();
        $response = $this->requester->query( 'sendVenue', $venue->toQuery() );

        return new Message( $response );
    }

    /**
     * Send contact
     *
     * Use this method to send phone contacts.
     *
     * On success, the sent message is returned as object of class "Message"
     *
     * @param SendContact $contact
     *
     * @return Message
     */
    public function sendContact ( SendContact $contact )
    {
        $contact->validateConstraints();
        $response = $this->requester->query( 'sendContact', $contact->toQuery() );

        return new Message( $response );
    }

    /**
     * Send chat action
     *
     * Use this method when you need to tell the user that something is happening on the bot's side.
     * The status is set for 5 seconds or less (when a message arrives from your bot, Telegram clients clear its typing status).
     *
     * @param SendChatAction $chatAction
     *
     * @return bool
     */
    public function sendChatAction ( SendChatAction $chatAction )
    {
        $response = $this->requester->query( 'sendChatAction', $chatAction->toQuery() );

        return $response;
    }

    // </editor-fold>

    // <editor-fold desc="Other actions">

    /**
     * Kick chat member
     *
     * Use this method to kick a user from a group or a supergroup.
     * In the case of supergroups, the user will not be able to return to the group on their own using invite links, etc., unless unbanned first.
     * The bot must be an administrator in the group for this to work.
     *
     * Note: This will method only work if the ‘All Members Are Admins’ setting is off in the target group.
     * Otherwise members may only be removed by the group's creator or by the member that added them.
     *
     * Returns True on success.
     *
     * @param ChatMemberSelector $chatMemberSelector
     *
     * @return boolean
     */
    public function kickChatMember ( ChatMemberSelector $chatMemberSelector )
    {
        $chatMemberSelector->validateConstraints();
        $response = $this->requester->query( 'kickChatMember', $chatMemberSelector->toQuery() );

        return $response;
    }

    /**
     * Leave chat
     *
     * Use this method for your bot to leave a group, supergroup or channel.
     *
     * Returns True on success.
     *
     * @param ChatSelector $chatSelector
     *
     * @return boolean
     */
    public function leaveChat ( ChatSelector $chatSelector )
    {
        $chatSelector->validateConstraints();
        $response = $this->requester->query( 'leaveChat', $chatSelector->toQuery() );

        return $response;
    }

    /**
     * Unban chat member
     *
     * Use this method to unban a previously kicked user in a supergroup.
     * The user will not return to the group automatically, but will be able to join via link, etc.
     * The bot must be an administrator in the group for this to work.
     *
     * Returns True on success.
     *
     * @param ChatMemberSelector $chatMemberSelector
     *
     * @return boolean
     */
    public function unbanChatMember ( ChatMemberSelector $chatMemberSelector )
    {
        $chatMemberSelector->validateConstraints();
        $response = $this->requester->query( 'unbanChatMember', $chatMemberSelector->toQuery() );

        return $response;
    }

    /**
     * Edit message text
     *
     * Use this method to edit text messages sent by the bot or via the bot (for inline bots).
     *
     * On success, if edited message is sent by the bot, the edited Message is returned, otherwise True is returned.
     *
     * @param EditMessageText $editMessageText
     *
     * @return Message|boolean
     */
    public function editMessageText ( EditMessageText $editMessageText )
    {
        $editMessageText->validateConstraints();
        $response = $this->requester->query( 'editMessageText', $editMessageText->toQuery() );

        if ( is_array( $response ) ) {
            return new Message( $response );
        } else {
            return $response;
        }
    }

    /**
     * Edit message caption
     *
     * Use this method to edit captions of messages sent by the bot or via the bot (for inline bots).
     *
     * On success, if edited message is sent by the bot, the edited Message is returned, otherwise True is returned.
     *
     * @param EditMessageCaption $editMessageCaption
     *
     * @return Message|boolean
     */
    public function editMessageCaption ( EditMessageCaption $editMessageCaption )
    {
        $editMessageCaption->validateConstraints();
        $response = $this->requester->query( 'editMessageCaption', $editMessageCaption->toQuery() );

        if ( is_array( $response ) ) {
            return new Message( $response );
        } else {
            return $response;
        }
    }

    /**
     * Edit message reply markup
     *
     * Use this method to edit only the reply markup of messages sent by the bot or via the bot (for inline bots).
     *
     * On success, if edited message is sent by the bot, the edited Message is returned, otherwise True is returned.
     *
     * @param EditMessageReplyMarkup $editMessageReplyMarkup
     *
     * @return Message|boolean
     */
    public function editMessageReplyMarkup ( EditMessageReplyMarkup $editMessageReplyMarkup )
    {
        $editMessageReplyMarkup->validateConstraints();
        $response = $this->requester->query( 'editMessageReplyMarkup', $editMessageReplyMarkup->toQuery() );

        if ( is_array( $response ) ) {
            return new Message( $response );
        } else {
            return $response;
        }
    }

    // </editor-fold>

    // TODO: Inline mode

    /**
     * Set webhook
     *
     * Use this method to specify a url and receive incoming updates via an outgoing webhook.
     * Whenever there is an update for the bot, we will send an HTTPS POST request to the specified url,
     * containing a JSON-serialized Update.
     *
     * In case of an unsuccessful request, we will give up after a reasonable amount of attempts.
     * If you'd like to make sure that the Webhook request comes from Telegram,
     * we recommend using a secret path in the URL, e.g. https://www.example.com/<token>.
     * Since nobody else knows your bot‘s token, you can be pretty sure it’s us.
     *
     * @param SetWebhook $webhook
     *
     * @return array
     */
    public function setWebhook ( SetWebhook $webhook )
    {
        $webhook->validateConstraints();
        $response = $this->requester->query( 'setWebhook', $webhook->toQuery( true ), true );

        return $response;
    }

    /**
     * Download file from Telegram
     *
     * @param string $serverPath
     * @param string $saveDir
     * @param string $saveFilename
     * @param string $saveFileExtension
     *
     * @return string
     */
    public function downloadTelegramFile ( $serverPath, $saveDir = './', $saveFilename = null, $saveFileExtension = null )
    {
        return $this->requester->downloadTelegramFile( $serverPath, $saveDir, $saveFilename, $saveFileExtension );
    }
}