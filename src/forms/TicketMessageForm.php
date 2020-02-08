<?php

namespace omny\yii2\ticket\component\forms;

use Exception;
use omny\yii2\ticket\component\models\TicketMessage;
use omny\yii2\ticket\component\repositories\TicketMessageRepository;
use Yii;
use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\di\NotInstantiableException;
use yii\web\Request;

/**
 * Class TicketMessageForm
 * @package omny\yii2\ticket\component\forms
 */
class TicketMessageForm extends Model
{
    /** @var string */
    public $message;
    /** @var int */
    private $ticketId;

    /** @var TicketMessageRepository */
    private $ticketMessageRepository;

    /**
     * @throws InvalidConfigException
     * @throws NotInstantiableException
     */
    public function init()
    {
        parent::init();

        $this->ticketMessageRepository = Yii::$container->get(TicketMessageRepository::class);
    }

    /**
     * @param int $ticketId
     */
    public function setTicketId(int $ticketId): void
    {
        $this->ticketId = $ticketId;
    }

    public function rules(): array
    {
        return [
            ['message', 'string', 'min' => 3]
        ];
    }

    /**
     * @param Request $request
     * @return TicketMessage|null
     * @throws Exception
     */
    public function handleRequest(Request $request): ?TicketMessage
    {
        if (! $request->isPost) {
            return null;
        }
        $this->load($request->post());

        return $this->ticketMessageRepository->create($this->message, $this->ticketId);
    }
}
