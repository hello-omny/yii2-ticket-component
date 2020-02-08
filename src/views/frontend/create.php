<?php

use \omny\yii2\tiket\component\forms\TicketForm;
use \yii\web\View;

/**
 * @var View $this
 * @var TicketForm $model
 */

$this->title = 'Новый тикет';
$this->params['breadcrumbs'][] = ['label' => 'Тикеты', 'url' => ['index']];

?>
<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <?= $this->render('../_common/_ticket-form', compact('model')) ?>
        </div>
    </div>
</div>
