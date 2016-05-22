<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:26
 */

namespace TelegramBotLibrary\APIModels\SendTypes;


class SendVenue extends SendLocation
{
    public $title;
    public $address;
    public $foursquare_id;
}