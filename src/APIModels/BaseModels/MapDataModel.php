<?php

namespace TelegramBotLibrary\APIModels\BaseModels;

use TelegramBotLibrary\APIModels\Enums\SystemCreateTypes;
use TelegramBotLibrary\Exceptions\TelegramRuntimeException;

abstract class MapDataModel
{
    /**
     * @var CreateType[]
     */
    protected $createTypeConfigurations = [];

    /**
     * BaseModel constructor.
     *
     * @param array $data
     * @param bool $useTypeMapper
     */
    public function __construct ( $data = [], $useTypeMapper = true )
    {
        $this->configure( $data );
        if ( !is_array( $data ) ) $data = [];

        if ( $useTypeMapper && !empty( $data ) ) {
            $this->mapData( $data );
        } else {
            foreach ( $data as $key => $value ) {
                $this->{$key} = $value;
            }
        }
    }

    // <editor-fold defaultstate="collapsed" desc="Конфигурация типа перед маппингом">

    abstract protected function configure ( $data );

    /**
     * Накладывает массив $data на объект,
     * создавая подобъекты на основе поля createWithConfiguration
     *
     * @param $data
     */
    public function mapData ( $data )
    {
        $createWithConfiguration = $this->getCreateTypeConfigurations();

        foreach ( $data as $dataKey => $dataValue ) {
            // Если для этого поля массива есть конфиг
            if ( isset( $createWithConfiguration[ $dataKey ] ) ) {
                $this->{$dataKey} = $this->prepareFieldToMap( $dataValue, $this->getCreateType( $dataKey ) );
            } else {
                $this->{$dataKey} = $dataValue;
            }
        }
    }

    /**
     * @return CreateType[]
     */
    protected function getCreateTypeConfigurations ()
    {
        return $this->createTypeConfigurations;
    }

    /**
     * Преобразует массив параметров $dataValue
     * в сущность, описанную в $createType
     *
     * @param                         $dataValue
     * @param CreateType $createType
     *
     * @return mixed
     * @throws TelegramRuntimeException
     */
    protected function prepareFieldToMap ( $dataValue, CreateType $createType )
    {
        switch ( $createType->getSystemType() ) {
            case SystemCreateTypes::Scalar:
                if ( $createType->getType() ) {
                    settype( $dataValue, $createType->getType() );
                }

                return $dataValue;

            case SystemCreateTypes::ArrayOfScalar:
                $arrayOfScalar = [];
                foreach ( $dataValue as $parentKey => $parentValue ) {
                    if ( $createType->getType() ) {
                        settype( $parentValue, $createType->getType() );
                    }
                    $arrayOfScalar[ $parentKey ] = $parentValue;
                }

                return $arrayOfScalar;

            case SystemCreateTypes::ArrayOfArrayOfScalar:
                $arrayOfArrayOfScalar = [];
                foreach ( $dataValue as $parentKey => $parentValue ) {
                    foreach ( $parentValue as $childKey => $childValue ) {
                        if ( $createType->getType() ) {
                            settype( $childValue, $createType->getType() );
                        }
                        $arrayOfArrayOfScalar[ $parentKey ][ $childKey ] = $childValue;
                    }
                }

                return $arrayOfArrayOfScalar;

            case SystemCreateTypes::Object:
                if ( $createType->getType() ) {
                    $class = $createType->getType();

                    return new $class( $dataValue );
                } else {
                    return (object)$dataValue;
                }

            case SystemCreateTypes::ArrayOfObjects:
                $arrayOfObjects = [];
                foreach ( $dataValue as $parentKey => $parentValue ) {
                    if ( $createType->getType() ) {
                        $class = $createType->getType();
                        $arrayOfObjects[ $parentKey ] = new $class( $parentValue );
                    } else {
                        $arrayOfObjects[ $parentKey ] = (object)$parentValue;
                    }
                }

                return $arrayOfObjects;

            case SystemCreateTypes::ArrayOfArrayOfObjects:
                $arrayOfArrayOfObjects = [];
                foreach ( $dataValue as $parentKey => $parentValue ) {
                    foreach ( $parentValue as $childKey => $childValue ) {
                        if ( $createType->getType() ) {
                            $class = $createType->getType();
                            $arrayOfArrayOfObjects[ $parentKey ][ $childKey ] = new $class( $childValue );
                        } else {
                            $arrayOfArrayOfObjects[ $parentKey ][ $childKey ] = (object)$childValue;
                        }
                    }
                }

                return $arrayOfArrayOfObjects;
        }

        throw new TelegramRuntimeException( 'Unexpected error' );
    }

    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Маппинг данных на объект">

    /**
     * @param $fieldName
     *
     * @return CreateType
     * @throws TelegramRuntimeException
     */
    protected function getCreateType ( $fieldName )
    {
        if ( !isset( $this->createTypeConfigurations[ $fieldName ] ) ) {
            throw new TelegramRuntimeException( ' There is no configuration for fieldname ' . $fieldName . ' in class ' . static::class );
        }

        return $this->createTypeConfigurations[ $fieldName ];
    }

    /**
     * @param string $fieldName
     *
     * @param CreateType $createType
     *
     * @return $this
     */
    protected function setCreateType ( $fieldName, CreateType $createType )
    {
        $this->createTypeConfigurations[ $fieldName ] = $createType;

        return $this;
    }

    // </editor-fold>

    /**
     * @param $fieldName
     *
     * @return $this
     */
    protected function unsetCreateType ( $fieldName )
    {
        $this->createTypeConfigurations[ $fieldName ] = null;
        unset( $this->createTypeConfigurations[ $fieldName ] );

        return $this;
    }
}