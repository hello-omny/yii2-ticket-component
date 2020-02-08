<?php

use \yii\helpers\HtmlPurifier;

/**
 * @var \yii\web\View $this
 * @var \omny\yii2\ticket\component\models\TicketMessage $model
 */

$currentUesrId = Yii::$app->getUser()->getId();

?>
<?php if ($currentUesrId !== (int)$model->user_id): ?>
    <div class="ticket-message col-8 offset-md-1">
        <div class="card">
            <div class="card-body">
                <div class="ticket-meta">
                    <span class="badge badge-primary">User</span>
                    <span class="ticket-meta__date"><?= Yii::$app->getFormatter()->asDatetime($model->created) ?></span>
                </div>
                <div class="ticket-message"><?= HtmlPurifier::process($model->text) ?></div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="ticket-message col-8">
        <div class="card">
            <div class="card-body">
                <div class="ticket-meta">
                    <span class="ticket-meta__date"><?= Yii::$app->getFormatter()->asDatetime($model->created) ?></span>
                </div>
                <div class="ticket-message"><?= HtmlPurifier::process($model->text) ?></div>
            </div>
        </div>
    </div>
<?php endif ?>

