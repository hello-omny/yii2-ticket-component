<?php

namespace omny\yii2\ticket\component\repositories;

use omny\yii2\ticket\component\models\TicketMessage;

/**
 * Class TicketMessageRepository
 * @package omny\yii2\ticket\component\repositories
 */
class TicketMessageRepository
{
    /**
     * @param string $message
     * @return TicketMessage
     * @throws \Exception
     */
    public function create(string $message, int $ticketId): TicketMessage
    {
        $ticketMessage = new TicketMessage();

        $ticketMessage->ticket_id = $ticketId;
        $ticketMessage->text = $message;
        $ticketMessage->user_id = \Yii::$app->getUser()->getId();
        $ticketMessage->created = (new \DateTime())->format('Y-m-d H:i:s');

        if (!$ticketMessage->save()) {
            throw new \RuntimeException('Ticket message not saved.');
        };

        return $ticketMessage;
    }
}
