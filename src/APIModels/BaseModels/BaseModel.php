<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 19:57
 */

namespace TelegramBotLibrary\APIModels\BaseModels;

use TelegramBotLibrary\Exceptions\TelegramBotException;

abstract class BaseModel
{
    /**
     * Описание типов переменных класса
     * При указании опции CreateWith будет создан экземпляр (или массив экзепляров) указанного класса
     * и будет передан ему в конструктор значение из config'а
     *
     * [
     *      'variable_name' => [
     *          'CreateWith' => [
     *              'type' => 'object || array || array of array',
     *              'class' => CLASS_NAME
     *          ]
     *      ]
     * ]
     */
    const TYPES = [];

    private function getTypes() {
        return static::TYPES;
    }

    public function __construct($config = [], $use_mapper = true) {
        if( !is_array($config) ) $config = [];

        $typesConfiguration = (object)json_decode(json_encode( $this->getTypes() ));

        foreach ($config as $key => $val) {
            // для этого поля массива есть конфиг в поле TYPES и используем маппер
            if( isset( $typesConfiguration->{$key} ) && $use_mapper === true ) {
                $keyConfigSet = $typesConfiguration->{$key};

                if( isset($keyConfigSet->CreateWith) ) {
                    if (!isset($keyConfigSet->CreateWith->type)) throw new TelegramBotException('Неверное описание CreateWith поля ' . $key . ' класса ' . get_class($this));

                    switch ($keyConfigSet->CreateWith->type) {
                        case 'object':
                            if (!isset($keyConfigSet->CreateWith->class)) {
                                throw new TelegramBotException('Неверное описание CreateWith поля ' . $key . ' класса ' . get_class($this));
                            }
                            $class = $keyConfigSet->CreateWith->class;
                            $this->$key = new $class($val);
                            break;

                        case 'array':
                            if (!isset($keyConfigSet->CreateWith->class)) {
                                throw new TelegramBotException('Неверное описание CreateWith поля ' . $key . ' класса ' . get_class($this));
                            }
                            $class = $keyConfigSet->CreateWith->class;
                            foreach ($val as $valKey => $valVal) {
                                $this->{$key}[$valKey] = new $class($valVal);
                            }
                            break;

                        case 'array of array':
                            if (!isset($keyConfigSet->CreateWith->class)) {
                                throw new TelegramBotException('Неверное описание CreateWith поля ' . $key . ' класса ' . get_class($this));
                            }
                            $class = $keyConfigSet->CreateWith->class;
                            foreach ($val as $valueKey => $valueArray) {
                                foreach ($valueArray as $valueInnerKey => $valueInnerValue) {
                                    $this->{$key}[$valueKey][$valueInnerKey] = new $class($valueInnerValue);
                                }
                            }
                            break;

                        default:
                            $this->{$key} = $val;
                            break;
                    }
                } else {
                    $this->$key = $val;
                }
            } else {
                $this->$key = $val;
            }
        }
    }

    public static function convertToArray($object) {
        if( is_object($object) ) $object = get_object_vars($object);

        $resultArray = [];
        foreach ($object as $key => $value) {
            if(!is_null($value)) {
                switch ( gettype($value) ) {
                    case 'object':
                        $resultArray[$key] = method_exists($value, 'convertToQuery') ? $value->convertToQuery() : $value;
                        break;

                    case 'array':
                        foreach ($value as $valKey => $valValue) {
                            $value[$valKey] = static::convertToArray($valValue);
                        }
                        $resultArray[$key] = $value;
                        break;

                    default:
                        $resultArray[$key] = $value;
                        break;
                }
            }
        }

        return $resultArray;
    }

    public function convertToQuery() {
        return static::convertToArray($this);
    }

    public function validate() {
        // TODO: проверка отправляемых данных
    }
}