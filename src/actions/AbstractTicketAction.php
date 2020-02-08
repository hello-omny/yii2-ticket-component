<?php

namespace omny\yii2\ticket\component\actions;

use omny\yii2\ticket\component\repositories\TicketRepository;
use yii\base\Action;
use yii\base\InvalidConfigException;
use yii\di\NotInstantiableException;

/**
 * Class AbstractTicketAction
 * @package omny\yii2\tiket\component\actions
 */
abstract class AbstractTicketAction extends Action
{
    /** @var TicketRepository */
    protected $ticketRepository;

    /**
     * @throws InvalidConfigException
     * @throws NotInstantiableException
     */
    public function init()
    {
        parent::init();

        $this->ticketRepository = \Yii::$container->get(TicketRepository::class);
    }
}
