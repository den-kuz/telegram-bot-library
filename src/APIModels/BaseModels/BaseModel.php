<?php

namespace TelegramBotLibrary\APIModels\BaseModels;

use TelegramBotLibrary\Exceptions\TelegramRuntimeException;

abstract class BaseModel
{
    /**
     * @var CreateWithConfiguration[]
     */
    protected $createWithConfiguration = [];

    public function __construct ( $data = [], $useTypeMapper = true )
    {
        $this->configure( $data );
        if ( !is_array( $data ) ) $data = [];

        if ( $useTypeMapper ) {
            $this->mapData( $data );
        } else {
            foreach ( $data as $key => $value ) {
                $this->{$key} = $value;
            }
        }
    }

    abstract protected function configure ( $data );

    /**
     * @param      $fieldName
     * @param      $typeName
     * @param null $type
     *
     * @return $this
     */
    protected function setCreateWithConfiguration ( $fieldName, $typeName, $type = null )
    {
        $this->createWithConfiguration[ $fieldName ] = new CreateWithConfiguration( $typeName, $type );

        return $this;
    }

    /**
     * @param $fieldName
     *
     * @return $this
     */
    protected function unsetCreateWithConfiguration ( $fieldName )
    {
        $this->createWithConfiguration[ $fieldName ] = null;
        unset( $this->createWithConfiguration[ $fieldName ] );

        return $this;
    }

    /**
     * @return CreateWithConfiguration[]
     */
    protected function getCreateWithConfiguration ()
    {
        return $this->createWithConfiguration;
    }

    public function mapData ( $data )
    {
        $createWithConfiguration = $this->getCreateWithConfiguration();

        foreach ( $data as $dataKey => $dataValue ) {
            // Если для этого поля массива есть конфиг
            if ( isset( $createWithConfiguration[ $dataKey ] ) ) {
                $this->{$dataKey} = $this->prepareFieldToMap( $dataValue, $createWithConfiguration[ $dataKey ] );
            } else {
                $this->{$dataKey} = $dataValue;
            }
        }
    }

    protected function prepareFieldToMap ( $dataValue, CreateWithConfiguration $createWithConfiguration )
    {
        if ( !CreateWithTypes::isValidValue( $createWithConfiguration->getSubType() ) ) {
            throw new TelegramRuntimeException( 'Wrong subtype name: ' . $createWithConfiguration->getSubType() );
        }

        switch ( $createWithConfiguration->getSubType() ) {
            case CreateWithTypes::Scalar:
                if ( $createWithConfiguration->getType() ) {
                    settype( $dataValue, $createWithConfiguration->getType() );
                }

                return $dataValue;

            case CreateWithTypes::ArrayOfScalar:
                $newArray = [];
                foreach ( $dataValue as $parentKey => $parentValue ) {
                    if ( $createWithConfiguration->getType() ) {
                        settype( $parentValue, $createWithConfiguration->getType() );
                    }
                    $newArray[ $parentKey ] = $parentValue;
                }

                return $newArray;

            case CreateWithTypes::ArrayOfArrayOfScalar:
                $newArray = [];
                foreach ( $dataValue as $parentKey => $parentValue ) {
                    foreach ( $parentValue as $childKey => $childValue ) {
                        if ( $createWithConfiguration->getType() ) {
                            settype( $childValue, $createWithConfiguration->getType() );
                        }
                        $newArray[ $parentKey ][ $childKey ] = $childValue;
                    }
                }

                return $newArray;

            case CreateWithTypes::Object:
                if ( $createWithConfiguration->getType() ) {
                    $class = $createWithConfiguration->getType();

                    return new $class( $dataValue );
                } else {
                    return (object)$dataValue;
                }

            case CreateWithTypes::ArrayOfObjects:
                $newArray = [];
                foreach ( $dataValue as $parentKey => $parentValue ) {
                    if ( $createWithConfiguration->getType() ) {
                        $class = $createWithConfiguration->getType();
                        $newArray[ $parentKey ] = new $class( $parentValue );
                    } else {
                        $newArray[ $parentKey ] = (object)$parentValue;
                    }
                }

                return $newArray;

            case CreateWithTypes::ArrayOfArrayOfObjects:
                $newArray = [];
                foreach ( $dataValue as $parentKey => $parentValue ) {
                    foreach ( $parentValue as $childKey => $childValue ) {
                        if ( $createWithConfiguration->getType() ) {
                            $class = $createWithConfiguration->getType();
                            $newArray[ $parentKey ][ $childKey ] = new $class( $childValue );
                        } else {
                            $newArray[ $parentKey ][ $childKey ] = (object)$childValue;
                        }
                    }
                }

                return $newArray;
        }

        throw new TelegramRuntimeException( 'Unexpected error' );
    }

    public function validate ()
    {
        // TODO: проверка типов данных
    }

    protected static function objectToArray ( $object )
    {
        if ( is_object( $object ) ) $object = get_object_vars( $object );

        $resultArray = [];
        foreach ( $object as $objectKey => $objectValue ) {
            if ( !is_null( $objectValue ) ) {
                switch ( gettype( $objectValue ) ) {
                    case 'object':
                        $resultArray[ $objectKey ] = method_exists( $objectValue, 'toArray' ) ? $objectValue->toArray() : $objectValue;
                        break;

                    case 'array':
                        foreach ( $objectValue as $parentKey => $parentValue ) {
                            $objectValue[ $parentKey ] = static::objectToArray( $parentValue );
                        }
                        $resultArray[ $objectKey ] = $objectValue;
                        break;

                    default:
                        $resultArray[ $objectKey ] = $objectValue;
                        break;
                }
            }
        }

        return $resultArray;
    }

    public function toArray ()
    {
        return static::objectToArray( $this );
    }
}