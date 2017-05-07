<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RetiradaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="retirada-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'retirada_id') ?>

    <?= $form->field($model, 'mes') ?>

    <?= $form->field($model, 'valor_roberto') ?>

    <?= $form->field($model, 'valor_juliana') ?>

    <?= $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
