<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:05
 */

namespace TelegramBotLibrary\APIModels\BaseTypes;


use TelegramBotLibrary\APIModels\BaseModels\BaseModel;

class Update extends BaseModel
{
    const TYPES = [
        'message' => [
            'CreateWith' => [
                'type'  => 'object',
                'class' => __NAMESPACE__ . '\\' . 'Message'
            ]
        ],

        'edited_message' => [
            'CreateWith' => [
                'type'  => 'object',
                'class' => __NAMESPACE__ . '\\' . 'Message'
            ]
        ]
    ];

    /**
     * @var int
     */
    public $update_id;

    /**
     * @var Message
     */
    public $message;

    /**
     * @var Message
     */
    public $edited_message;
}