<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Categoria;
use kartik\date\DatePicker;
use kartik\money\MaskMoney;
?>

<div class="despesa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'categoria_id')->dropDownList(ArrayHelper::map(Categoria::find()->where(['status' => 1])->orderBy(['descricao' => SORT_ASC])->all(), 'categoria_id', 'descricao'), ['prompt' => 'Selecione a Categoria']) ?>

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
