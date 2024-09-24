<?php

use app\modules\admin\models\Order;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить заказ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'created_at',
                'format' => 'datetime'
            ],
            'updated_at',
            'qty',
            'total',
            [
                'attribute' => 'status',
                'value' => fn($data) => $data->status ? '<span class="text-green">Обработан</span>' : '<span class="text-red">Новый</span>',
                'format' => 'raw'
            ],
            // 'status',
            //'name',
            //'email:email',
            //'phone',
            //'address',
            //'note:ntext',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Order $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
                 'header' => 'Действие'
            ],
        ],
    ]); ?>


</div>
