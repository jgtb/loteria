<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\money\MaskMoney;
?>

<div class="servico-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=
    $form->field($model, 'data')->widget(DatePicker::className(), [
        'language' => 'pt-BR',
        'removeButton' => ['icon' => 'trash'],
        'pluginOptions' => [
            'todayHighlight' => true,
            'format' => 'dd/mm/yyyy',
            'autoclose' => true,
        ],
    ])
    ?>

    <?=
    $form->field($model, 'valor')->widget(MaskMoney::classname(), [
        'pluginOptions' => [
            'prefix' => 'R$ ',
            'allowNegative' => false,
            'allowZero' => true,
            'thousands' => '.',
            'decimal' => ',',
        ]
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Alterar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
