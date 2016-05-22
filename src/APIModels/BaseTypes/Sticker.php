<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:04
 */

namespace TelegramBotLibrary\APIModels\BaseTypes;

use TelegramBotLibrary\APIModels\BaseModels\BaseModel;

class Sticker extends BaseModel
{
    const TYPES = [
        'thumb' => [
            'CreateWith' => [
                'type'  => 'object',
                'class' => __NAMESPACE__ . '\\' . 'PhotoSize'
            ]
        ]
    ];

    public $file_id;
    public $width;
    public $height;
    public $thumb;
    public $emoji;
    public $file_size;
}