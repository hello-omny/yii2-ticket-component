<?php

namespace omny\yii2\ticket\component\actions;

use omny\yii2\ticket\component\forms\TicketMessageForm;
use yii\data\ActiveDataProvider;

/**
 * Class ViewAction
 * @package omny\yii2\tiket\component\actions
 */
class ViewAction extends AbstractTicketAction
{
    /**
     * @param int $id
     * @return mixed
     */
    public function run(int $id)
    {
        $ticket = $this->ticketRepository->findActiveById($id);
        $messages = new ActiveDataProvider([
            'query' => $ticket->getActiveTicketMessages()
        ]);

        $ticketMessageForm = new TicketMessageForm(['ticketId' => $ticket->id]);
        $result = $ticketMessageForm->handleRequest(\Yii::$app->getRequest());
        if ($result !== null) {
            return $this->controller->redirect(['view', 'id' => $id]);
        }

        return $this->controller->render('view', compact('ticket', 'messages', 'ticketMessageForm'));
    }
}
