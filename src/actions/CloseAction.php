<?php

namespace omny\yii2\ticket\component\actions;

use yii\web\NotFoundHttpException;
use \yii\web\Response;

/**
 * Class CloseAction
 * @package omny\yii2\ticket\component\actions
 */
class CloseAction extends AbstractTicketAction
{
    /**
     * @param int $id
     * @return Response
     * @throws NotFoundHttpException
     */
    public function run(int $id): Response
    {
        $ticket = $this->ticketRepository->close($id);

        return $this->controller->redirect('index');
    }
}
