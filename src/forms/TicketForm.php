<?php

namespace omny\yii2\ticket\component\forms;

use omny\yii2\ticket\component\models\Ticket;
use omny\yii2\ticket\component\repositories\TicketRepository;
use yii\base\Model;
use yii\web\Request;

/**
 * Class TicketForm
 * @package omny\yii2\ticket\component\forms
 */
class TicketForm extends Model
{
    /** @var string */
    public $message;

    /** @var TicketRepository */
    private $ticketRepository;

    /**
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    public function init()
    {
        parent::init();

        $this->ticketRepository = \Yii::$container->get(TicketRepository::class);
    }

    public function rules(): array
    {
        return [
            ['message', 'string', 'min' => 3]
        ];
    }

    /**
     * @param Request $request
     * @return Ticket|null
     */
    public function handleRequest(Request $request): ?Ticket
    {
        if (! $request->isPost) {
            return null;
        }
        $this->load($request->post());

        return $this->ticketRepository->create($this->message);
    }
}
