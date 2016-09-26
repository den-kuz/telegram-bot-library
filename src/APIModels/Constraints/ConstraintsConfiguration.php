<?php

namespace TelegramBotLibrary\APIModels\Constraints;

use TelegramBotLibrary\APIModels\Interfaces\ConstraintInterface;
use TelegramBotLibrary\Exceptions\TelegramConstraintException;

class ConstraintsConfiguration
{
    /**
     * @var ConstraintInterface[]
     */
    protected $constraints;

    protected $allowNull;

    public function __construct ( array $constraints, $allowNull = true )
    {
        if ( empty( $constraints ) ) throw new TelegramConstraintException( 'Constraints array must not be empty' );

        $this->constraints = $constraints;
        $this->allowNull = $allowNull;
    }

    public function isValidValue ( $dataValue )
    {
        if ( is_null( $dataValue ) ) return $this->allowNull;

        $allPassed = true;
        foreach ( $this->constraints as $constraint ) {
            if ( !$constraint->isValid( $dataValue ) ) {
                $allPassed = false;
                break;
            }
        }

        return $allPassed;
    }

    public function getConstraintsDescription ()
    {
        $strings = [];
        foreach ( $this->constraints as $constraint ) {
            $strings[] = '(' . $constraint->getDescription() . ')';
        }

        return '[' . implode( ' AND ', $strings ) . ']';
    }
}