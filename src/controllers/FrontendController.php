<?php

namespace omny\yii2\ticket\component\controllers;

use omny\yii2\ticket\component\models\Ticket;
use omny\yii2\ticket\component\forms\TicketForm;
use omny\yii2\ticket\component\forms\TicketMessageForm;
use omny\yii2\ticket\component\repositories\TicketRepository;
use yii\data\ActiveDataProvider;

/**
 * Class FrontendController
 * @package omny\yii2\ticket\component\controllers
 */
class FrontendController extends AbstractController
{
    /** @var string */
    protected $viewPath = '@vendor/omny/yii2-ticket-component/src/views/frontend';
    /** @var TicketRepository */
    private $ticketRepository;

    /**
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    public function init()
    {
        parent::init();

        /** @var TicketRepository $ticketRepository */
        $this->ticketRepository = \Yii::$container->get(TicketRepository::class);
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->ticketRepository->getAllActiveQueryForUser(\Yii::$app->getUser()->getId())
        ]);
        
        return $this->render('index', compact('dataProvider'));
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new TicketForm();
        $result = $model->handleRequest(\Yii::$app->getRequest());

        if ($result !== null) {
            return $this->redirect('index');
        }

        return $this->render('create', compact('model'));
    }

    /**
     * @param int $id
     * @return string
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionView(int $id)
    {
        $ticket = $this->ticketRepository->findActiveById($id);
        $messages = new ActiveDataProvider([
            'query' => $ticket->getActiveTicketMessages()
        ]);

        $ticketMessageForm = new TicketMessageForm(['ticketId' => $ticket->id]);
        $result = $ticketMessageForm->handleRequest(\Yii::$app->getRequest());
        if ($result !== null) {
            return $this->redirect(['view', 'id' => $id]);
        }
        
        return $this->render('view', compact('ticket', 'messages', 'ticketMessageForm'));
    }
}
