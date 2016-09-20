<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 19.09.2016
 * Time: 18:58
 */

namespace TelegramBotLibrary\APIModels\BaseModels;


class CreateWithConfiguration
{
    protected $subType = '';

    protected $type;

    /**
     * CreateWithDescription constructor.
     *
     * @param string $subType
     * @param        $type
     */
    public function __construct ( $subType, $type = null )
    {
        $this->subType = $subType;
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getSubType ()
    {
        return $this->subType;
    }

    /**
     * @return null
     */
    public function getType ()
    {
        return $this->type;
    }
}