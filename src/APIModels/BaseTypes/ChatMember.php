<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 23:37
 */

namespace TelegramBotLibrary\APIModels\BaseTypes;


use TelegramBotLibrary\APIModels\BaseModels\BaseModel;

class ChatMember extends BaseModel
{
    const TYPES = [
        'user' => [
            'availableTypes' => [
                'CreateWith' => [
                    'type'  => 'object',
                    'class' => __NAMESPACE__ . '\\' . 'User'
                ]
            ]
        ]
    ];

    public $user;
    public $status;
}