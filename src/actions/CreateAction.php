<?php

namespace omny\yii2\ticket\component\actions;

use omny\yii2\ticket\component\forms\TicketForm;

/**
 * Class CreateAction
 * @package omny\yii2\ticket\component\actions
 */
class CreateAction extends AbstractTicketAction
{
    /**
     * @return mixed
     */
    public function run()
    {
        $model = new TicketForm();
        $result = $model->handleRequest(\Yii::$app->getRequest());

        if ($result !== null) {
            return $this->controller->redirect('index');
        }

        return $this->controller->render('create', compact('model'));
    }
}
