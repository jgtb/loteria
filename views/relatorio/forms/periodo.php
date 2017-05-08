<?php

use yii\helpers\Html;
use kartik\date\DatePicker;
use yii\bootstrap\ActiveForm;
?>
<div id="periodo" class="tab-pane fade <?= in_array($modelRelatorio->id, [7, 12, 13, 14, 15]) ? 'in active' : '' ?>">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->dropDownList([12 => 'Jogos', 13 => 'Serviços', 7 => 'Despesas', 14 => 'Retiradas', 15 => 'Resumo'], ['prompt' => 'Selecione um Relatório']) ?>

    <?=
    $form->field($model, 'periodo')->widget(DatePicker::classname(), [
        'language' => 'pt-BR',
        'attribute' => 'periodo_inicial',
        'attribute2' => 'periodo_final',
        'options' => ['placeholder' => 'Inicial'],
        'options2' => ['placeholder' => 'Final'],
        'separator' => '<i class="glyphicon glyphicon-resize-horizontal"></i>',
        'type' => DatePicker::TYPE_RANGE,
        'removeButton' => ['icon' => 'trash'],
        'pluginOptions' => [
            'todayHighlight' => true,
            'format' => 'dd/mm/yyyy',
            'autoclose' => true,
        ],
    ])->label('Período Inicial e Final');
    ?>

    <div class="form-group">
        <?= Html::submitButton('Gerar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>