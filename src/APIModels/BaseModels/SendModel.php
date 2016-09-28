<?php

namespace TelegramBotLibrary\APIModels\BaseModels;

use ReflectionObject;
use TelegramBotLibrary\APIModels\Constraints\ConstraintsConfiguration;
use TelegramBotLibrary\APIModels\Enums\PropertyFilterTypes;
use TelegramBotLibrary\Exceptions\TelegramConstraintException;
use TelegramBotLibrary\Exceptions\TelegramRuntimeException;

abstract class SendModel
{
    /**
     * @var ConstraintsConfiguration[][]
     */
    protected $constraintsConfigurations = [];

    /**
     * BaseSendModel constructor.
     *
     */
    public function __construct ()
    {
        $this->configure();
    }

    protected abstract function configure ();

    /**
     * Проверяет все ограничения
     * Выбрасывает исключения в случае если хотя бы одно поле не совпало со всеми его возможными конфигурациями
     *
     * @throws TelegramRuntimeException
     */
    public function validateConstraints ()
    {
        $properties = $this->getProperties();

        foreach ( $properties as $propertyName => $propertyValue ) {
            if ( isset( $this->constraintsConfigurations[ $propertyName ] ) ) {
                $passed = false;
                foreach ( $this->constraintsConfigurations[ $propertyName ] as $constraintsConfiguration ) {
                    if ( $constraintsConfiguration->isValidValue( $propertyValue ) ) {
                        $passed = true;
                        break;
                    }
                }

                if ( !$passed ) {
                    throw new TelegramConstraintException(
                        'Field "' . $propertyName . '" ' .
                        'of class ' . static::class . ' ' .
                        'is not in allowed values. ' .
                        'Allowed values: ' . $this->getConstraintsConfigurationAsString( $propertyName )
                    );
                }
            }
        }
    }

    protected abstract function getProperties();

    /**
     * Возвращает все ограничения для указанного поля в виде строки
     *
     * @param $fieldName
     *
     * @return string
     */
    protected function getConstraintsConfigurationAsString ( $fieldName )
    {
        if ( !isset( $this->constraintsConfigurations[ $fieldName ] ) ) return '';

        $constraintsConfigurations = $this->constraintsConfigurations[ $fieldName ];

        $constraintsConfigurationsAsString = [];
        foreach ( $constraintsConfigurations as $constraintsConfiguration ) {
            $constraintsConfigurationsAsString[] = $constraintsConfiguration->getConstraintsDescription();
        }

        return '[ ' . implode( ' OR ', $constraintsConfigurationsAsString ) . ' ]';
    }

    /**
     * Приводит объект к виду, пригодному для запроса в Telegram
     *
     * @param bool $keepNulls
     *
     * @return array
     */
    public function toQuery ( $keepNulls = false )
    {
        return static::querify( $this->getProperties(), $keepNulls );
    }

    /**
     * Преобразует объект в массив скалярных объектов
     *
     * @param      $object
     * @param bool $keepNulls
     *
     * @return array
     * @throws TelegramRuntimeException
     */
    protected static function querify ( $object, $keepNulls = false )
    {
        if ( !is_object( $object ) && !is_array( $object ) ) {
            throw new TelegramRuntimeException( 'Variable to querify must be an array or object' );
        }

        $array = [];
        if ( is_object( $object ) ) {
            if ( method_exists( $object, 'toQuery' ) ) {
                return $object->toQuery( $keepNulls );
            } else {
                $array = static::getObjectProperties( $object );
            }
        } elseif ( is_array( $object ) ) {
            $array = $object;
        }

        $resultArray = [];
        foreach ( $array as $arrayKey => $arrayValue ) {
            if ( !is_null( $arrayValue ) || $keepNulls ) {
                switch ( gettype( $arrayValue ) ) {
                    case 'object':
                    case 'array':
                        $resultArray[ $arrayKey ] = static::querify( $arrayValue, $keepNulls );
                        break;

                    default:
                        $resultArray[ $arrayKey ] = $arrayValue;
                        break;
                }
            }
        }

        return $resultArray;
    }

    /**
     * Преобразует любой объект в массив ключ-значение
     *
     * @param     $object
     * @param int $filter
     *
     * @return array
     */
    protected static function getObjectProperties ( $object, $filter = PropertyFilterTypes::PUBLIC )
    {
        $reflectionObj = new ReflectionObject( $object );
        $propertiesArray = $reflectionObj->getProperties( $filter );

        $filteredArray = [];
        for ( $i = 0; $i < count( $propertiesArray ); $i++ ) {
            $filteredArray[ $propertiesArray[ $i ]->getName() ] = $propertiesArray[ $i ]->getValue( $object );
        }

        return $filteredArray;
    }

    /**
     * Добавляет конфигурацию ограничений для указанного поля
     *
     * @param string $fieldName
     * @param ConstraintsConfiguration $constraintsConfiguration
     *
     * @return $this
     */
    protected function addConstraintsConfiguration ( $fieldName, ConstraintsConfiguration $constraintsConfiguration )
    {
        $this->constraintsConfigurations[ $fieldName ][] = $constraintsConfiguration;

        return $this;
    }

    /**
     * Сбрасывает конфигурацию ограничений для указаного поля
     *
     * @param $fieldName
     *
     * @return $this
     */
    protected function resetConstraintsConfigurations ( $fieldName )
    {
        $this->constraintsConfigurations[ $fieldName ] = [];

        return $this;
    }
}