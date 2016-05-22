<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:03
 */

namespace TelegramBotLibrary\APIModels\BaseTypes;


use TelegramBotLibrary\APIModels\BaseModels\BaseModel;

class Message extends BaseModel
{
    const TYPES = [
        'from'                  => [
            'CreateWith' => [
                'type'  => 'object',
                'class' => __NAMESPACE__ . '\\' . 'User'
            ]
        ],
        'chat'                  => [
            'CreateWith' => [
                'type'  => 'object',
                'class' => __NAMESPACE__ . '\\' . 'Chat'
            ]
        ],
        'forward_from'          => [
            'CreateWith' => [
                'type'  => 'object',
                'class' => __NAMESPACE__ . '\\' . 'User'
            ]
        ],
        'forward_from_chat'     => [
            'CreateWith' => [
                'type'  => 'object',
                'class' => __NAMESPACE__ . '\\' . 'Chat'
            ]
        ],
        'reply_to_message'      => [
            'CreateWith' => [
                'type'  => 'object',
                'class' => __NAMESPACE__ . '\\' . 'Message'
            ]
        ],
        'entities'              => [
            'CreateWith' => [
                'type'  => 'array',
                'class' => __NAMESPACE__ . '\\' . 'MessageEntity'
            ]
        ],
        'audio'                 => [
            'CreateWith' => [
                'type'  => 'object',
                'class' => __NAMESPACE__ . '\\' . 'Audio'
            ]
        ],
        'document'              => [
            'CreateWith' => [
                'type'  => 'object',
                'class' => __NAMESPACE__ . '\\' . 'Document'
            ]
        ],
        'photo'                 => [
            'CreateWith' => [
                'type'  => 'object',
                'class' => __NAMESPACE__ . '\\' . 'PhotoSize'
            ]
        ],
        'sticker'               => [
            'CreateWith' => [
                'type'  => 'object',
                'class' => __NAMESPACE__ . '\\' . 'Sticker'
            ]
        ],
        'video'                 => [
            'CreateWith' => [
                'type'  => 'object',
                'class' => __NAMESPACE__ . '\\' . 'Video'
            ]
        ],
        'voice'                 => [
            'CreateWith' => [
                'type'  => 'object',
                'class' => __NAMESPACE__ . '\\' . 'Voice'
            ]
        ],
        'contact'               => [
            'CreateWith' => [
                'type'  => 'object',
                'class' => __NAMESPACE__ . '\\' . 'Contact'
            ]
        ],
        'location'              => [
            'CreateWith' => [
                'type'  => 'object',
                'class' => __NAMESPACE__ . '\\' . 'Location'
            ]
        ],
        'venue'                 => [
            'CreateWith' => [
                'type'  => 'object',
                'class' => __NAMESPACE__ . '\\' . 'Venue'
            ]
        ],
        'new_chat_member'       => [
            'CreateWith' => [
                'type'  => 'object',
                'class' => __NAMESPACE__ . '\\' . 'User'
            ]
        ],
        'new_chat_participant'  => [
            'CreateWith' => [
                'type'  => 'object',
                'class' => __NAMESPACE__ . '\\' . 'User'
            ]
        ],
        'left_chat_member'      => [
            'CreateWith' => [
                'type'  => 'object',
                'class' => __NAMESPACE__ . '\\' . 'User'
            ]
        ],
        'left_chat_participant' => [
            'CreateWith' => [
                'type'  => 'object',
                'class' => __NAMESPACE__ . '\\' . 'User'
            ]
        ],
        'new_chat_photo'        => [
            'CreateWith' => [
                'type'  => 'object',
                'class' => __NAMESPACE__ . '\\' . 'PhotoSize'
            ]
        ],
        'pinned_message'        => [
            'CreateWith' => [
                'type'  => 'object',
                'class' => __NAMESPACE__ . '\\' . 'Message'
            ]
        ]
    ];

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
     * @var PhotoSize
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
     * @var    Location
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
     * @return MessageEntity[]
     */
    public function getEntities($type)
    {
        $entities = [];
        if (is_array($this->entities)) {
            foreach ($this->entities as $entity) {
                if ($entity->type == $type) $entities[] = $entity;
            }
        }
        
        return $entities;
    }
}