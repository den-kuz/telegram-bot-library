<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:04
 */

namespace TelegramBotLibrary\APIModels\BaseTypes;


use TelegramBotLibrary\APIModels\BaseModels\BaseModel;

class MessageEntity extends BaseModel
{
    const TYPES = [
        'user' => [
            'CreateWith' => [
                'type' => 'object',
                'class' => __NAMESPACE__ . '\\' . 'User'
            ]
        ]
    ];

    public $type;
    public $offset;
    public $length;
    public $url;

    /**
     * @var User
     */
    public $user;

    public function getEntityVal($text)
    {
        return mb_substr($text, $this->offset, $this->length);
    }

    public function getTextExcludeEntity($text)
    {
        return trim(mb_substr($text, $this->offset + $this->length, mb_strlen($text)));
    }
}