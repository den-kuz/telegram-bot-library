<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:05
 */

namespace TelegramBotLibrary\APIModels\BaseTypes;


use TelegramBotLibrary\APIModels\BaseModels\BaseModel;

class Video extends BaseModel
{
    const TYPES = [
        'thumb' => [
            'availableTypes' => [
                'CreateWith' => [
                    'type'  => 'object',
                    'class' => __NAMESPACE__ . '\\' . 'PhotoSize'
                ]
            ]
        ]
    ];

    public $file_id;
    public $width;
    public $height;
    public $duration;
    public $thumb;
    public $mime_type;
    public $file_size;
}