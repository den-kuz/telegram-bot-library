<?php
/**
 * Created by PhpStorm.
 * User: d.kuznetsov
 * Date: 22.05.2016
 * Time: 20:19
 */

namespace TelegramBotLibrary\APIModels\BaseTypes\Keyboard;

use TelegramBotLibrary\APIModels\BaseModels\SendModel;
use TelegramBotLibrary\APIModels\Constraints\ConstraintsConfiguration;
use TelegramBotLibrary\APIModels\Constraints\IsBoolean;

class ForceReply extends SendModel
{
    /**
     * @var boolean
     */
    protected $force_reply = true;

    /**
     * @var boolean
     */
    protected $selective;

    protected function configure ()
    {
        $this
            ->addConstraintsConfiguration( 'force_reply', new ConstraintsConfiguration( [ new IsBoolean() ], false ) )
            ->addConstraintsConfiguration( 'selective', new ConstraintsConfiguration( [ new IsBoolean() ], true ) );

        return $this;
    }

    protected function getProperties ()
    {
        return [
            'force_reply' => $this->getForceReply(),
            'selective'   => $this->getSelective(),
        ];
    }

    /**
     * @return boolean
     */
    public function getForceReply ()
    {
        return $this->force_reply;
    }

    /**
     * @return boolean
     */
    public function getSelective ()
    {
        return $this->selective;
    }

    /**
     * @param boolean $selective
     *
     * @return $this
     */
    public function setSelective ( $selective )
    {
        $this->selective = $selective;

        return $this;
    }

    public function toQuery ( $keepNulls = false )
    {
        return json_encode( parent::toQuery( $keepNulls ) );
    }
}