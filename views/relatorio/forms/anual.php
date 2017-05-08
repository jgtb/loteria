<?php

use yii\helpers\Html;
use kartik\date\DatePicker;
use yii\bootstrap\ActiveForm;
?>
<div id="anual" class="tab-pane fade <?= in_array($modelRelatorio->id, [NULL, 1, 2, 3, 4, 5]) ? 'in active' : '' ?>">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->dropDownList([1 => 'Jogos', 2 => 'Serviços', 3 => 'Despesas', 5 => 'Retiradas', 4 => 'Resumo'], ['prompt' => 'Selecione um Relatório']) ?>

    <?=
    $form->field($model, 'ano')->widget(DatePicker::className(), [
        'language' => 'pt-BR',
        'removeButton' => ['icon' => 'trash'],
        'pluginOptions' => [
            'format' => 'yyyy',
            'autoclose' => true,
            'minViewMode' => 2,
        ],
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Gerar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>