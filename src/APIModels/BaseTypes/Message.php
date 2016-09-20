<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:03
 */

namespace TelegramBotLibrary\APIModels\BaseTypes;


use TelegramBotLibrary\APIModels\BaseModels\BaseModel;
use TelegramBotLibrary\APIModels\BaseModels\CreateWithTypes;

class Message extends BaseModel
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
     * @var integer
     */
    public $edit_date;

    /**
     * @var Message
     */
    public $reply_to_message;

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
            ->setCreateWithConfiguration( 'message_id', CreateWithTypes::Scalar, 'integer' )
            ->setCreateWithConfiguration( 'from', CreateWithTypes::Object, User::class )
            ->setCreateWithConfiguration( 'date', CreateWithTypes::Scalar, 'integer' )
            ->setCreateWithConfiguration( 'chat', CreateWithTypes::Object, Chat::class )
            ->setCreateWithConfiguration( 'forward_from', CreateWithTypes::Object, User::class )
            ->setCreateWithConfiguration( 'forward_from_chat', CreateWithTypes::Object, Chat::class )
            ->setCreateWithConfiguration( 'forward_date', CreateWithTypes::Scalar, 'integer' )
            ->setCreateWithConfiguration( 'edit_date', CreateWithTypes::Scalar, 'integer' )
            ->setCreateWithConfiguration( 'reply_to_message', CreateWithTypes::Object, Message::class )
            ->setCreateWithConfiguration( 'text', CreateWithTypes::Scalar, 'string' )
            ->setCreateWithConfiguration( 'entities', CreateWithTypes::ArrayOfObjects, MessageEntity::class )
            ->setCreateWithConfiguration( 'audio', CreateWithTypes::Object, Audio::class )
            ->setCreateWithConfiguration( 'document', CreateWithTypes::Object, Document::class )
            ->setCreateWithConfiguration( 'photo', CreateWithTypes::ArrayOfObjects, PhotoSize::class )
            ->setCreateWithConfiguration( 'sticker', CreateWithTypes::Object, Sticker::class )
            ->setCreateWithConfiguration( 'video', CreateWithTypes::Object, Video::class )
            ->setCreateWithConfiguration( 'voice', CreateWithTypes::Object, Voice::class )
            ->setCreateWithConfiguration( 'caption', CreateWithTypes::Scalar, 'string' )
            ->setCreateWithConfiguration( 'contact', CreateWithTypes::Object, Contact::class )
            ->setCreateWithConfiguration( 'location', CreateWithTypes::Object, Location::class )
            ->setCreateWithConfiguration( 'venue', CreateWithTypes::Object, Venue::class )
            ->setCreateWithConfiguration( 'new_chat_member', CreateWithTypes::Object, User::class )
            ->setCreateWithConfiguration( 'new_chat_participant', CreateWithTypes::Object, User::class )
            ->setCreateWithConfiguration( 'left_chat_member', CreateWithTypes::Object, User::class )
            ->setCreateWithConfiguration( 'left_chat_participant', CreateWithTypes::Object, User::class )
            ->setCreateWithConfiguration( 'new_chat_title', CreateWithTypes::Scalar, 'string' )
            ->setCreateWithConfiguration( 'new_chat_photo', CreateWithTypes::ArrayOfObjects, PhotoSize::class )
            ->setCreateWithConfiguration( 'delete_chat_photo', CreateWithTypes::Scalar, 'boolean' )
            ->setCreateWithConfiguration( 'group_chat_created', CreateWithTypes::Scalar, 'boolean' )
            ->setCreateWithConfiguration( 'supergroup_chat_created', CreateWithTypes::Scalar, 'boolean' )
            ->setCreateWithConfiguration( 'channel_chat_created', CreateWithTypes::Scalar, 'boolean' )
            ->setCreateWithConfiguration( 'migrate_to_chat_id', CreateWithTypes::Scalar, 'integer' )
            ->setCreateWithConfiguration( 'migrate_from_chat_id', CreateWithTypes::Scalar, 'integer' )
            ->setCreateWithConfiguration( 'pinned_message', CreateWithTypes::Object, Message::class );
    }
}