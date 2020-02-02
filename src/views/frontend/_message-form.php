<?php

use \yii\web\View;
use \omny\yii2\ticket\component\forms\TicketMessageForm;
use \yii\bootstrap4\ActiveForm;
use \yii\helpers\Html;

/**
 * @var View $this
 * @var TicketMessageForm $ticketMessageForm
 */

$form = ActiveForm::begin();

echo $form->field($ticketMessageForm, 'message')->textarea();
echo Html::submitButton('Написать');

ActiveForm::end();