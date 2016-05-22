<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 21:06
 */

namespace TelegramBotLibrary\APIModels\BaseModels;


abstract class BaseEnum {
    private $current_val;

    final public function __construct( $type ) {
        $class_name = get_class( $this );

        $type = strtoupper( $type );
        if ( constant( "{$class_name}::{$type}" )  === NULL ) {
            throw new \Exception( 'Свойства '.$type.' в перечислении '.$class_name.' не найдено.' );
        }

        $this->current_val = constant( "{$class_name}::{$type}" );
    }

    final public function __toString() {
        return $this->current_val;
    }
}