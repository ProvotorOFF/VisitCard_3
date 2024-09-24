<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\Order $model */

$this->title = "Заказ $model->id";
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
\yii\web\YiiAsset::register($this);
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'created_at:datetime',
            'updated_at:datetime',
            'qty',
            'total',
            [
                'attribute' => 'status',
                'value' => $model->status ? '<span class="text-green">Обработан</span>' : '<span class="text-red">Новый</span>',
                'format' => 'raw'
            ],
            'name',
            'email:email',
            'phone',
            'address',
            'note:ntext',
        ],
    ]) ?>

</div>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Товары в заказе</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <th>Наименование</th>
                            <th>Кол-во</th>
                            <th>Цена</th>
                            <th>Сумма</th>
                        </tr>
                        <? foreach ($model->orderProduct as $item): ?>
                            <tr>
                                <td><?= $item->id ?></td>
                                <td><?= $item->title ?></td>
                                <td><?= $item->qty ?></td>
                                <td><?= $item->price ?></td>
                                <td><?= $item->total ?></td>
                            </tr>
                        <? endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>