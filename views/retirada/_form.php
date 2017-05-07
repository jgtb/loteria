<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\money\MaskMoney;
?>

<div class="retirada-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=
    $form->field($model, 'mes')->widget(DatePicker::className(), [
        'language' => 'pt-BR',
        'removeButton' => ['icon' => 'trash'],
        'pluginOptions' => [
          'format' => 'mm/yyyy',
          'autoclose' => true,
          'minViewMode' => 1,
        ],
    ])
    ?>

    <?=
    $form->field($model, 'valor_roberto')->widget(MaskMoney::classname(), [
        'pluginOptions' => [
            'prefix' => 'R$ ',
            'allowNegative' => false,
            'allowZero' => true,
            'thousands' => '.',
            'decimal' => ',',
        ]
    ]);
    ?>

    <?=
    $form->field($model, 'valor_juliana')->widget(MaskMoney::classname(), [
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
