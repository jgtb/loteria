<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
use kartik\money\MaskMoney;

$this->title = 'Retiradas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="retirada-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Nova Retirada', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(['id' => 'pjax-retirada', 'timeout' => false, 'enablePushState' => false, 'clientOptions' => ['method' => 'POST']]); ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => false,
        'emptyText' => 'Nenhum resultado encontrado.',
        'tableOptions' => ['class' => 'table table-striped table-bordered table-condensed table-responsive'],
        'columns' => [
            ['attribute' => 'mes', 'format' => 'raw', 'filter' => DatePicker::widget(['model' => $searchModel, 'attribute' => 'mes', 'language' => 'pt-BR', 'removeButton' => ['icon' => 'trash'], 'pluginOptions' => ['format' => 'mm/yyyy', 'autoclose' => true, 'minViewMode' => 1]]), 'value' => function ($model) {
                    return $model->getMes() . '<br>' . date('Y', strtotime($model->mes)) . '<br>' . 'Total: R$ ' . $model->getTotal();
                }],
            ['attribute' => 'valor_roberto', 'format' => 'raw', 'filter' => MaskMoney::widget(['model' => $searchModel, 'attribute' => 'valor_roberto', 'pluginOptions' => ['prefix' => 'R$ ', 'allowNegative' => false, 'allowZero' => true, 'thousands' => '.', 'decimal' => ',',]]), 'value' => function ($model) {
                    return 'R$ ' . number_format($model->valor_roberto, 2, ',', '.');
                }],
            ['attribute' => 'valor_juliana', 'format' => 'raw', 'filter' => MaskMoney::widget(['model' => $searchModel, 'attribute' => 'valor_juliana', 'pluginOptions' => ['prefix' => 'R$ ', 'allowNegative' => false, 'allowZero' => true, 'thousands' => '.', 'decimal' => ',',]]), 'value' => function ($model) {
                    return 'R$ ' . number_format($model->valor_juliana, 2, ',', '.');
                }],
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'contentOptions' => ['style' => 'width: 10%;'],
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-edit"></span>', $url, ['class' => 'btn btn-xs btn-primary', 'data-pjax' => 0, 'title' => 'Alterar Retirada']);
                    },
                    'delete' => function ($url, $model, $key) use ($id) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, ['class' => 'btn btn-xs btn-danger', 'title' => 'Excluír Retirada', 'data-pjax' => 0, 'data-confirm' => 'Você tem certeza que deseja excluír este item?', 'data-method' => 'post']);
                    }
                ]
            ],
        ],
    ]);
    ?>

    <?php Pjax::end(); ?>

</div>
