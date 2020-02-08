<?php

use \yii\web\View;
use \omny\yii2\ticket\component\models\Ticket;
use \omny\yii2\ticket\component\models\TicketMessage;
use \yii\widgets\DetailView;
use \omny\yii2\ticket\component\forms\TicketMessageForm;
use \yii\widgets\ListView;

/**
 * @var View $this
 * @var Ticket $ticket
 * @var array|TicketMessage[] $messages
 * @var TicketMessageForm $ticketMessageForm
 */

$this->title = $ticket->title;
$this->params['breadcrumbs'][] = ['label' => 'Тикеты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col-5">
                    <?= $this->render('../_common/_message-form', compact('ticketMessageForm')) ?>
                </div>
            </div>
            <hr>
            <?= ListView::widget([
                'dataProvider' => $messages,
                'itemView' => '_message-view',
                'summary' => false,
                'itemOptions' => [
                    'tag' => 'div',
                    'class' => 'row mb-3'
                ]
            ]) ?>
        </div>
    </div>
</div>
