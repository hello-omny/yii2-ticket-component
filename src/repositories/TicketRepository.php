<?php

namespace omny\yii2\ticket\component\repositories;

use Exception;
use omny\yii2\ticket\component\models\Ticket;
use Yii;
use yii\db\ActiveQuery;
use yii\helpers\StringHelper;
use yii\web\NotFoundHttpException;

/**
 * Class TicketRepository
 * @package omny\yii2\tiket\component\repositories
 */
class TicketRepository
{
    /**
     * @param string $message
     * @return Ticket|null
     */
    public function create(string $message): ?Ticket
    {
        $transaction = Yii::$app->getDb()->beginTransaction();
        try {
            $ticket = $this->newTicket($message);

            /** @var TicketMessageRepository $ticketMessageRepository */
            $ticketMessageRepository = Yii::$container->get(TicketMessageRepository::class);
            $ticketMessageRepository->create($message, $ticket->id);

            $transaction->commit();
            return $ticket;
        } catch (\Throwable $exception) {
            $transaction->rollBack();
            Yii::warning($exception->getMessage());
        }

        return null;
    }

    /**
     * @param int $id
     * @return bool
     * @throws NotFoundHttpException
     */
    public function close(int $id): bool
    {
        $ticket = $this->findById($id);
        $ticket->status = Ticket::STATUS_CLOSED;

        return $ticket->save();
    }

    /**
     * @param int $id
     * @return Ticket
     * @throws NotFoundHttpException
     */
    public function findById(int $id): Ticket
    {
        $model = Ticket::findOne($id);

        if ($model !== null) {
            return $model;
        }

        throw new NotFoundHttpException("Ticket {$id} not found.");
    }

    /**
     * @param int $id
     * @return Ticket
     * @throws NotFoundHttpException
     */
    public function findActiveById(int $id): Ticket
    {
        $model = Ticket::find()
            ->alias('t')
            ->where([
                't.id' => $id,
                't.status' => Ticket::STATUS_NEW
            ])
            ->one();

        if ($model !== null) {
            return $model;
        }

        throw new NotFoundHttpException("Ticket {$id} not found or unavailable.");
    }

    /**
     * @return ActiveQuery
     */
    public function getAllActiveQuery(): ActiveQuery
    {
        return Ticket::find()
            ->alias('t')
            ->where([
                't.status' => Ticket::STATUS_NEW
            ]);
    }

    /**
     * @param int $userId
     * @return ActiveQuery
     */
    public function getAllActiveQueryForUser(int $userId): ActiveQuery
    {
        return Ticket::find()
            ->alias('t')
            ->where([
                't.user_id' => $userId,
                't.status' => Ticket::STATUS_NEW
            ]);
    }

    /**
     * @param $message
     * @return Ticket
     * @throws Exception
     */
    private function newTicket($message): Ticket
    {
        $ticket = new Ticket();

        $ticket->title = StringHelper::truncateWords($message, 5);
        $ticket->user_id = Yii::$app->getUser()->getId();
        $ticket->theme_id = 1;
        $ticket->created = (new \DateTime())->format('Y-m-d H:i:s');

        if (!$ticket->save()) {
            throw new RuntimeException('Ticket not saved.');
        };

        return $ticket;
    }
}
