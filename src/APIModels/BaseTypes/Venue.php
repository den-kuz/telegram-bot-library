<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:38
 */

namespace TelegramBotLibrary\APIModels\BaseTypes;


use TelegramBotLibrary\APIModels\BaseModels\BaseModel;

class Venue extends BaseModel
{
    const TYPES = [
        'location' => [
            'CreateWith' => [
                'type'  => 'object',
                'class' => __NAMESPACE__ . '\\' . 'Location'
            ]
        ]
    ];
    
    public $location;
    public $title;
    public $address;
    public $foursquare_id;
}