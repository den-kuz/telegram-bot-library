<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 19.09.2016
 * Time: 18:58
 */

namespace TelegramBotLibrary\APIModels\BaseModels;

use TelegramBotLibrary\APIModels\Enums\SystemCreateTypes;
use TelegramBotLibrary\Exceptions\TelegramRuntimeException;

class CreateType
{
    protected $systemType;

    protected $type;

    /**
     * CreateType constructor.
     *
     * @param string $systemType
     * @param        $type
     *
     * @throws TelegramRuntimeException
     */
    public function __construct ( $systemType, $type = null )
    {
        if ( !SystemCreateTypes::isValidValue( $systemType ) ) {
            throw new TelegramRuntimeException(
                'Invalid system create type. Possible values: ' . implode( ', ', SystemCreateTypes::getConstList() )
            );
        }

        $this->systemType = $systemType;
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getSystemType ()
    {
        return $this->systemType;
    }

    /**
     * @return null
     */
    public function getType ()
    {
        return $this->type;
    }
}