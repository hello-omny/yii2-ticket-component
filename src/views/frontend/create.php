<?php

use \omny\yii2\tiket\component\forms\TicketForm;
use \yii\web\View;

/**
 * @var View $this
 * @var TicketForm $model
 */

?>

<div class="container">
    <div class="row">
        <div class="col">
            <?= $this->render('_ticket-form', compact('model')) ?>
        </div>
    </div>
</div>
