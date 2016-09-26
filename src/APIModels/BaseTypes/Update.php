<?php

namespace TelegramBotLibrary\APIModels\BaseTypes;

use TelegramBotLibrary\APIModels\BaseModels\CreateType;
use TelegramBotLibrary\APIModels\BaseModels\MapDataModel;
use TelegramBotLibrary\APIModels\Enums\ScalarCreateTypes;
use TelegramBotLibrary\APIModels\Enums\SystemCreateTypes;

class Update extends MapDataModel
{
    /**
     * @var integer
     */
    public $update_id;

    /**
     * @var Message
     */
    public $message;

    /**
     * @var Message
     */
    public $edited_message;

    /**
     * @var InlineQuery
     */
    public $inline_query;

    /**
     * @var ChosenInlineResult
     */
    public $chosen_inline_result;

    /**
     * @var CallbackQuery
     */
    public $callback_query;



    protected function configure ( $data )
    {
        $this
            ->setCreateType( 'update_id', new CreateType( SystemCreateTypes::Scalar, ScalarCreateTypes::INTEGER ) )
            ->setCreateType( 'message', new CreateType( SystemCreateTypes::Object, Message::class ) )
            ->setCreateType( 'edited_message', new CreateType( SystemCreateTypes::Object, Message::class ) )
            ->setCreateType( 'inline_query', new CreateType( SystemCreateTypes::Object, InlineQuery::class ) )
            ->setCreateType( 'chosen_inline_result', new CreateType( SystemCreateTypes::Object, ChosenInlineResult::class ) )
            ->setCreateType( 'callback_query', new CreateType( SystemCreateTypes::Object, CallbackQuery::class ) );

        return $this;
    }
}