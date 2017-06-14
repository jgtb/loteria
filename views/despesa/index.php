<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
use kartik\money\MaskMoney;
use app\models\Categoria;

$this->title = 'Despesas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="index despesa-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= Html::a('Nova Despesa', ['create'], ['class' => 'btn btn-warning']) ?>

    <?php Pjax::begin(['id' => 'pjax-despesa', 'timeout' => false, 'enablePushState' => false, 'clientOptions' => ['method' => 'POST']]); ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => false,
        'emptyText' => 'Nenhum resultado encontrado.',
        'tableOptions' => ['class' => 'table table-striped table-bordered table-condensed table-responsive'],
        'columns' => [
            ['attribute' => 'categoria_id', 'filter' => ArrayHelper::map(Categoria::find()->where(['status' => 1])->orderBy(['descricao' => SORT_ASC])->all(), 'categoria_id', 'descricao'), 'value' => function ($model) {
                    return $model->categoria->descricao;
                }],
            ['attribute' => 'data', 'format' => 'raw', 'filter' => DatePicker::widget(['model' => $searchModel, 'attribute' => 'data', 'language' => 'pt-BR', 'removeButton' => ['icon' => 'trash'], 'pluginOptions' => ['format' => 'mm/yyyy', 'autoclose' => true, 'minViewMode' => 1]]), 'value' => function ($model) {
                    return date('d/m/Y', strtotime($model->data));
                }],
            ['attribute' => 'valor', 'format' => 'raw', 'filter' => MaskMoney::widget(['model' => $searchModel, 'attribute' => 'valor', 'pluginOptions' => ['prefix' => 'R$ ', 'allowNegative' => false, 'allowZero' => true, 'thousands' => '.', 'decimal' => ',',]]), 'value' => function ($model) {
                    return 'R$ ' . number_format($model->valor, 2, ',', '.');
                }],
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-edit"></span>', $url, ['class' => 'btn btn-xs btn-primary', 'data-pjax' => 0, 'title' => 'Alterar Despesa']);
                    },
                    'delete' => function ($url, $model, $key) use ($id) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, ['class' => 'btn btn-xs btn-danger', 'title' => 'Excluír Despesa', 'data-pjax' => 0, 'data-confirm' => 'Você tem certeza que deseja excluír este item?', 'data-method' => 'post']);
                    }
                ]
            ],
        ],
    ]);
    ?>

    <?php Pjax::end(); ?>

</div>
