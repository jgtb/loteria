<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Jogo */

$this->title = $model->jogo_id;
$this->params['breadcrumbs'][] = ['label' => 'Jogos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jogo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->jogo_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->jogo_id], [
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
            'jogo_id',
            'data',
            'valor',
            'status',
        ],
    ]) ?>

</div>
