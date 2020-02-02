<?php

use \yii\web\View;
use \omny\yii2\ticket\component\models\Ticket;
use \omny\yii2\ticket\component\models\TicketMessage;
use \yii\widgets\DetailView;
use \omny\yii2\ticket\component\forms\TicketMessageForm;

/**
 * @var View $this
 * @var Ticket $ticket
 * @var array|TicketMessage[] $messages
 * @var TicketMessageForm $ticketMessageForm
 */

$this->title = $ticket->title;
$this->params['breadcrumbs'][] = ['label' => 'Tickets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="container">
    <div class="row">
        <div class="col">
            <?= DetailView::widget([
                'model' => $ticket
            ]) ?>
            <hr>
            <?= \yii\grid\GridView::widget([
                'dataProvider' => $messages
            ]) ?>
            <hr>
            <?= $this->render('_message-form', compact('ticketMessageForm')) ?>
        </div>
    </div>
</div>
