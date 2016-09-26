<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:03
 */

namespace TelegramBotLibrary\APIModels\BaseTypes;

use TelegramBotLibrary\APIModels\BaseModels\CreateType;
use TelegramBotLibrary\APIModels\BaseModels\MapDataModel;
use TelegramBotLibrary\APIModels\Enums\ScalarCreateTypes;
use TelegramBotLibrary\APIModels\Enums\SystemCreateTypes;

class Message extends MapDataModel
{
    /**
     * @var integer
     */
    public $message_id;

    /**
     * @var User
     */
    public $from;

    /**
     * @var integer
     */
    public $date;

    /**
     * @var Chat
     */
    public $chat;

    /**
     * @var User
     */
    public $forward_from;

    /**
     * @var Chat
     */
    public $forward_from_chat;

    /**
     * @var integer
     */
    public $forward_date;

    /**
     * @var Message
     */
    public $reply_to_message;

    /**
     * @var integer
     */
    public $edit_date;

    /**
     * @var string
     */
    public $text;

    /**
     * @var MessageEntity[]
     */
    public $entities;

    /**
     * @var Audio
     */
    public $audio;

    /**
     * @var Document
     */
    public $document;

    /**
     * @var PhotoSize[]
     */
    public $photo;

    /**
     * @var Sticker
     */
    public $sticker;

    /**
     * @var Video
     */
    public $video;

    /**
     * @var Voice
     */
    public $voice;

    /**
     * @var string
     */
    public $caption;

    /**
     * @var Contact
     */
    public $contact;

    /**
     * @var Location
     */
    public $location;

    /**
     * @var Venue
     */
    public $venue;

    /**
     * @var User
     */
    public $new_chat_member;

    /**
     * @var User
     */
    public $new_chat_participant;

    /**
     * @var User
     */
    public $left_chat_member;

    /**
     * @var User
     */
    public $left_chat_participant;

    /**
     * @var string
     */
    public $new_chat_title;

    /**
     * @var PhotoSize[]
     */
    public $new_chat_photo;

    /**
     * @var boolean
     */
    public $delete_chat_photo;

    /**
     * @var boolean
     */
    public $group_chat_created;

    /**
     * @var boolean
     */
    public $supergroup_chat_created;

    /**
     * @var boolean
     */
    public $channel_chat_created;

    /**
     * @var integer
     */
    public $migrate_to_chat_id;

    /**
     * @var integer
     */
    public $migrate_from_chat_id;

    /**
     * @var Message
     */
    public $pinned_message;



    /**
     * @param $type
     *
     * @return MessageEntity[]
     */
    public function getEntitiesByType ( $type )
    {
        $entities = [];
        if ( is_array( $this->entities ) ) {
            foreach ( $this->entities as $entity ) {
                if ( $entity->type == $type ) $entities[] = $entity;
            }
        }

        return $entities;
    }



    protected function configure ( $data )
    {
        $this
            ->setCreateType( 'message_id', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::INTEGER ) )
            ->setCreateType( 'from', new CreateType( SystemCreateTypes::Object, User::class ) )
            ->setCreateType( 'date', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::INTEGER ) )
            ->setCreateType( 'chat', new CreateType( SystemCreateTypes::Object, Chat::class ) )
            ->setCreateType( 'forward_from', new CreateType( SystemCreateTypes::Object, User::class ) )
            ->setCreateType( 'forward_from_chat', new CreateType( SystemCreateTypes::Object, Chat::class ) )
            ->setCreateType( 'forward_date', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::INTEGER ) )
            ->setCreateType( 'edit_date', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::INTEGER ) )
            ->setCreateType( 'reply_to_message', new CreateType( SystemCreateTypes::Object, Message::class ) )
            ->setCreateType( 'text', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::STRING ) )
            ->setCreateType( 'entities', new CreateType( SystemCreateTypes::ArrayOfObjects, MessageEntity::class ) )
            ->setCreateType( 'audio', new CreateType( SystemCreateTypes::Object, Audio::class ) )
            ->setCreateType( 'document', new CreateType( SystemCreateTypes::Object, Document::class ) )
            ->setCreateType( 'photo', new CreateType( SystemCreateTypes::ArrayOfObjects, PhotoSize::class ) )
            ->setCreateType( 'sticker', new CreateType( SystemCreateTypes::Object, Sticker::class ) )
            ->setCreateType( 'video', new CreateType( SystemCreateTypes::Object, Video::class ) )
            ->setCreateType( 'voice', new CreateType( SystemCreateTypes::Object, Voice::class ) )
            ->setCreateType( 'caption', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::STRING ) )
            ->setCreateType( 'contact', new CreateType( SystemCreateTypes::Object, Contact::class ) )
            ->setCreateType( 'location', new CreateType( SystemCreateTypes::Object, Location::class ) )
            ->setCreateType( 'venue', new CreateType( SystemCreateTypes::Object, Venue::class ) )
            ->setCreateType( 'new_chat_member', new CreateType( SystemCreateTypes::Object, User::class ) )
            ->setCreateType( 'new_chat_participant', new CreateType( SystemCreateTypes::Object, User::class ) )
            ->setCreateType( 'left_chat_member', new CreateType( SystemCreateTypes::Object, User::class ) )
            ->setCreateType( 'left_chat_participant', new CreateType( SystemCreateTypes::Object, User::class ) )
            ->setCreateType( 'new_chat_title', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::STRING ) )
            ->setCreateType( 'new_chat_photo', new CreateType( SystemCreateTypes::ArrayOfObjects, PhotoSize::class ) )
            ->setCreateType( 'delete_chat_photo', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::BOOLEAN ) )
            ->setCreateType( 'group_chat_created', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::BOOLEAN ) )
            ->setCreateType( 'supergroup_chat_created', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::BOOLEAN ) )
            ->setCreateType( 'channel_chat_created', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::BOOLEAN ) )
            ->setCreateType( 'migrate_to_chat_id', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::INTEGER ) )
            ->setCreateType( 'migrate_from_chat_id', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::INTEGER ) )
            ->setCreateType( 'pinned_message', new CreateType( SystemCreateTypes::Object, Message::class ) );

        return $this;
    }
}