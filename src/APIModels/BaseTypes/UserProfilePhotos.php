<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 21:20
 */

namespace TelegramBotLibrary\APIModels\BaseTypes;


use TelegramBotLibrary\APIModels\BaseModels\BaseModel;

class UserProfilePhotos extends BaseModel
{
    const TYPES = [
        'photos' => [
            'availableTypes' => [
                'CreateWith' => [
                    'type'  => 'array of array',
                    'class' => __NAMESPACE__ . '\\' . 'PhotoSize'
                ]
            ]
        ]
    ];
    
    public $total_count;
    public $photos;
}