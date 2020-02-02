<?php

use \yii\grid\GridView;
use \yii\web\View;
use \yii\data\ActiveDataProvider;
use \yii\helpers\Html;

/**
 * @var View $this
 * @var ActiveDataProvider $dataProvider
 */

$this->title = 'Тикеты';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="container">
    <div class="row">
        <div class="col">
            <p>
                <?= Html::a('Создать', ['create'], ['class' => 'btn btn-sm btn-success']) ?>
            </p>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
            ]) ?>
        </div>
    </div>
</div>
