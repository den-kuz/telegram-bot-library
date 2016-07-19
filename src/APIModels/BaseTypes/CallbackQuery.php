<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 19.07.2016
 * Time: 22:59
 */

namespace TelegramBotLibrary\APIModels\BaseTypes;


use TelegramBotLibrary\APIModels\BaseModels\BaseModel;

class CallbackQuery extends BaseModel
{

    const TYPES = [
        'from' => [
            'CreateWith' => [
                'type' => 'object',
                'class' => __NAMESPACE__ . '\\' . 'User'
            ]
        ],
        'message' => [
            'CreateWith' => [
                'type' => 'object',
                'class' => __NAMESPACE__ . '\\' . 'Message'
            ]
        ]
    ];

    public $id;
    public $from;
    public $message;
    public $inline_message_id;
    public $data;
}