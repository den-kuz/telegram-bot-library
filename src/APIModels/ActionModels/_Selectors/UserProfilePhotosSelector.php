<?php

namespace TelegramBotLibrary\APIModels\ActionModels\_Selectors;

use TelegramBotLibrary\APIModels\BaseModels\SendModel;
use TelegramBotLibrary\APIModels\Constraints\ConstraintsConfiguration;
use TelegramBotLibrary\APIModels\Constraints\IsInteger;
use TelegramBotLibrary\APIModels\Constraints\IsIntegerMinMax;

class UserProfilePhotosSelector extends SendModel
{
    /**
     * @var integer
     */
    protected $user_id;

    /**
     * @var integer
     */
    protected $offset;

    /**
     * @var integer
     */
    protected $limit;

    protected function configure ()
    {
        $this
            ->addConstraintsConfiguration( 'user_id', new ConstraintsConfiguration( [ new IsInteger() ], false ) )
            ->addConstraintsConfiguration( 'offset', new ConstraintsConfiguration( [ new IsInteger() ], true ) )
            ->addConstraintsConfiguration( 'limit', new ConstraintsConfiguration( [ new IsIntegerMinMax( 1, 100 ) ], true ) );

        return $this;
    }

    protected function getProperties ()
    {
        return [
            'user_id' => $this->getUserId(),
            'offset'  => $this->getOffset(),
            'limit'   => $this->getLimit(),
        ];
    }

    /**
     * @return int
     */
    public function getUserId ()
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     *
     * @return UserProfilePhotosSelector
     */
    public function setUserId ( $user_id )
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * @return int
     */
    public function getOffset ()
    {
        return $this->offset;
    }

    /**
     * @param int $offset
     *
     * @return UserProfilePhotosSelector
     */
    public function setOffset ( $offset )
    {
        $this->offset = $offset;

        return $this;
    }

    /**
     * @return int
     */
    public function getLimit ()
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     *
     * @return UserProfilePhotosSelector
     */
    public function setLimit ( $limit )
    {
        $this->limit = $limit;

        return $this;
    }
}