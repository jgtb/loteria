<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
use kartik\money\MaskMoney;

$this->title = 'Comissão de Serviços';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="index servico-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= Html::a('Nova Comissão de Serviços', ['create'], ['class' => 'btn btn-warning']) ?>

    <?php Pjax::begin(['id' => 'pjax-servico', 'timeout' => false, 'enablePushState' => false, 'clientOptions' => ['method' => 'POST']]); ?>


    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => false,
        'emptyText' => 'Nenhum resultado encontrado.',
        'tableOptions' => ['class' => 'table table-striped table-bordered table-condensed table-responsive'],
        'columns' => [
            ['attribute' => 'data', 'format' => 'raw', 'filter' => DatePicker::widget(['model' => $searchModel, 'attribute' => 'data', 'language' => 'pt-BR', 'removeButton' => ['icon' => 'trash'], 'pluginOptions' => ['format' => 'mm/yyyy', 'autoclose' => true, 'minViewMode' => 1]]), 'value' => function ($model) {
                    return date('d/m/Y', strtotime($model->data));
                }],
            ['attribute' => 'valor', 'format' => 'raw', 'filter' => MaskMoney::widget(['model' => $searchModel, 'attribute' => 'valor', 'pluginOptions' => ['prefix' => 'R$ ', 'allowNegative' => false, 'allowZero' => true, 'thousands' => '.', 'decimal' => ',',]]), 'value' => function ($model) {
                    return 'R$ ' . number_format($model->valor, 2, ',', '.');
                }],
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'options' => ['style' => 'width: 7%;'],
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-edit"></span>', $url, ['class' => 'btn btn-xs btn-primary', 'data-pjax' => 0, 'title' => 'Alterar Serviço']);
                    },
                    'delete' => function ($url, $model, $key) use ($id) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, ['class' => 'btn btn-xs btn-danger', 'title' => 'Excluír Serviço', 'data-pjax' => 0, 'data-confirm' => 'Você tem certeza que deseja excluír este item?', 'data-method' => 'post']);
                    }
                ]
            ],
        ],
    ]);
    ?>

    <?php Pjax::end(); ?>

</div>
