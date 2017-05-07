<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Retirada */

$this->title = $model->retirada_id;
$this->params['breadcrumbs'][] = ['label' => 'Retiradas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="retirada-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->retirada_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->retirada_id], [
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
            'retirada_id',
            'mes',
            'valor_roberto',
            'valor_juliana',
            'status',
        ],
    ]) ?>

</div>
