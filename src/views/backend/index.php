<?php

use \yii\grid\GridView;
use \yii\web\View;
use \yii\data\ActiveDataProvider;
use \yii\helpers\Html;
use \omny\yii2\ticket\component\models\Ticket;
use \yii\grid\SerialColumn;
use \yii\grid\ActionColumn;
use \yii\helpers\HtmlPurifier;

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
                'columns' => [
                    [
                        'class' => SerialColumn::class
                    ],

                    [
                        'attribute' => 'title',
                        'content' => function (Ticket $model) {
                            return Html::a($model->title, ['view', 'id' => $model->id]);
                        }
                    ],
                    [
                        'header' => 'Last message',
                        'content' => function(Ticket $model) {
                            return HtmlPurifier::process($model->getLastTicketMessage()->text);
                        }
                    ],
                    'status',
                    'created',
                    'theme.title:text:Тема',

                    [
                        'class' => ActionColumn::class,
                        'template' => '{close}',
                        'buttons' => [
                            'close' => function ($url, $model, $key) {
                                return Html::a('Закрыть', $url);
                            },
                        ]
                    ],
                ]
            ]) ?>
        </div>
    </div>
</div>
