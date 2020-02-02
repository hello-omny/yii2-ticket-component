<?php

use \yii\web\View;
use \omny\yii2\ticket\component\forms\TicketForm;
use \yii\bootstrap4\ActiveForm;
use \yii\bootstrap4\Html;

/**
 * @var View $this
 * @var TicketForm $model
 */

$form = ActiveForm::begin();

echo $form->field($model, 'message')->textarea();
echo Html::submitButton('Создать');

ActiveForm::end();
