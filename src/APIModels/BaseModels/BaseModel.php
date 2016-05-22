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
     * Описываются каждый в своем классе
     *
     * Доступные типы - возвращаемые функцией gettype PHP:
     * boolean, integer, double, string, array, object, resource, NULL
     *
     * Установите ключ CreateWith для того чтобы создавать объект с этим классом
     *
     * Типы и названия классов регистрозависимы! Указывайте типы так, как описано выше
     * и названия классов
     * Шаблоны описания типов (один или несколько описаний из раздела 'types'
     * [
     *      'variable_name' => [
     *          'availableTypes' => [
     *              [
     *                  'type'  => 'integer'
     *              ],
     *              [
     *                  'type'  => 'boolean'
     *              ],
     *              [
     *                  'type'  => 'double'
     *              ],
     *              [
     *                  'type'  => 'string'
     *              ],
     *              [
     *                  'type'  => 'array'
     *              ],
     *              [
     *                  'type'  => 'array',
     *                  'typeOf' => 'integer|boolean|double|string|object|array|resource|NULL'
     *              ],
     *              [
     *                  'type'  => 'array',
     *                  'typeOf' => 'object'
     *                  'classOf' => 'ClassName'
     *              ],
     *              [
     *                  'type'  => 'object'
     *              ],
     *              'CreateWith' => [
     *                  'type'  => 'object',
     *                  'class' => 'ClassName'
     *              ],
     *              [
     *                  'type'  => 'resource'
     *              ],
     *              [
     *                  'type'  => 'NULL'
     *              ]
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
            // для этого поля массива есть конфиг в поле TYPES
            if( isset( $typesConfiguration->{$key} ) && $use_mapper === true ) {
                $keyConfigSet = $typesConfiguration->{$key};

                // в конфиге есть описание типов
                if( isset($keyConfigSet->availableTypes) )  {
                    $typesSet = $keyConfigSet->availableTypes;

                    if( isset($typesSet->CreateWith) && !isset($typesSet->CreateWith->type)) {
                        throw new TelegramBotException('Неверное описание CreateWith поля ' . $key . ' класса ' . get_class($this));
                    }
                    
                    switch ($typesSet->CreateWith->type) {
                        case 'object':
                            if( !isset($typesSet->CreateWith->class) ) {
                                throw new TelegramBotException('Неверное описание CreateWith поля ' . $key . ' класса ' . get_class($this));
                            }
                            $class = $typesSet->CreateWith->class;
                            $this->$key = new $class($val);
                            break;
                        
                        case 'array':
                            if( !isset($typesSet->CreateWith->class) ) {
                                throw new TelegramBotException('Неверное описание CreateWith поля ' . $key . ' класса ' . get_class($this));
                            }
                            $class = $typesSet->CreateWith->class;
                            foreach ($val as $valKey => $valVal) {
                                $this->{$key}[$valKey] = new $class($valVal);
                            }
                            break;
                        
                        case 'array of array':
                            if( !isset($typesSet->CreateWith->class) ) {
                                throw new TelegramBotException('Неверное описание CreateWith поля ' . $key . ' класса ' . get_class($this));
                            }
                            $class = $typesSet->CreateWith->class;
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