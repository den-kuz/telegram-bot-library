<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:01
 */

namespace TelegramBotLibrary\APIModels\BaseTypes;

use TelegramBotLibrary\APIModels\BaseModels\BaseModel;

class Document extends BaseModel
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
    public $thumb;
    public $file_name;
    public $mime_type;
    public $file_size;
}