<?php

namespace TelegramBotLibrary\APIModels\BaseTypes;

use TelegramBotLibrary\APIModels\BaseModels\BaseModel;
use TelegramBotLibrary\APIModels\BaseModels\CreateWithTypes;

class Update extends BaseModel
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
            ->setCreateWithConfiguration( 'update_id', CreateWithTypes::Scalar, 'integer' )
            ->setCreateWithConfiguration( 'message', CreateWithTypes::Object, Message::class )
            ->setCreateWithConfiguration( 'edited_message', CreateWithTypes::Object, Message::class )
            ->setCreateWithConfiguration( 'inline_query', CreateWithTypes::Object, InlineQuery::class )
            ->setCreateWithConfiguration( 'chosen_inline_result', CreateWithTypes::Object, ChosenInlineResult::class )
            ->setCreateWithConfiguration( 'callback_query', CreateWithTypes::Object, CallbackQuery::class );
    }
}