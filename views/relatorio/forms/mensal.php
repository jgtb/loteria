<?php

use yii\helpers\Html;
use kartik\date\DatePicker;
use yii\bootstrap\ActiveForm;
?>
<div id="mensal" class="tab-pane fade <?= in_array($modelRelatorio->id, [6]) ? 'in active' : '' ?>">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->dropDownList([6 => 'Despesas'], ['prompt' => 'Selecione um Relatório']) ?>

    <?=
    $form->field($model, 'mes_ano')->widget(DatePicker::className(), [
        'language' => 'pt-BR',
        'removeButton' => ['icon' => 'trash'],
        'pluginOptions' => [
            'format' => 'mm/yyyy',
            'autoclose' => true,
            'minViewMode' => 1,
        ],
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Gerar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>