<?php

namespace omny\yii2\ticket\component\controllers;

use omny\yii2\ticket\component\actions\CloseAction;
use omny\yii2\ticket\component\repositories\TicketRepository;
use omny\yii2\ticket\component\actions\ViewAction;
use Yii;
use yii\base\InvalidConfigException;
use yii\data\ActiveDataProvider;
use yii\di\NotInstantiableException;

/**
 * Class BackendController
 * @package omny\yii2\ticket\component\controllers
 */
class BackendController extends AbstractController
{
    /** @var string */
    protected $viewPath = '@vendor/omny/yii2-ticket-component/src/views/backend';
    /** @var TicketRepository */
    private $ticketRepository;

    /**
     * @throws InvalidConfigException
     * @throws NotInstantiableException
     */
    public function init()
    {
        parent::init();

        $this->ticketRepository = Yii::$container->get(TicketRepository::class);
    }

    /**
     * @return array
     */
    public function actions(): array
    {
        return [
            'view' => ViewAction::class,
            'close' => CloseAction::class,
        ];
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->ticketRepository->getAllActiveQuery()
        ]);

        return $this->render('index', compact('dataProvider'));
    }
}
