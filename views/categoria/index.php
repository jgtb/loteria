<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Categorias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="index categoria-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= Html::a('Nova Categoria', ['create'], ['class' => 'btn btn-warning']) ?>

    <?php Pjax::begin(['id' => 'pjax-categoria', 'timeout' => false, 'enablePushState' => false, 'clientOptions' => ['method' => 'POST']]); ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => false,
        'emptyText' => 'Nenhum resultado encontrado.',
        'tableOptions' => ['class' => 'table table-striped table-bordered table-condensed table-responsive'],
        'columns' => [
            ['attribute' => 'descricao', 'value' => function ($model) {
                    return $model->descricao;
                }],
            ['class' => 'yii\grid\ActionColumn',
                'visible' => $dataProvider->getModels() != NULL,
                'template' => '{update} {delete}',
                'options' => ['style' => 'width: 10%;'],
                'header' => 'Opcões',
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-edit"></span>', $url, ['class' => 'btn btn-xs btn-primary m-r-5', 'data-pjax' => 0, 'title' => 'Alterar Categoria']);
                    },
                    'delete' => function ($url, $model, $key) use ($id) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, ['class' => 'btn btn-xs btn-danger', 'title' => 'Excluír Categoria', 'data-pjax' => 0, 'data-confirm' => 'Você tem certeza que deseja excluír este item?', 'data-method' => 'post']);
                    }
                ]
            ],
        ],
    ]);
    ?>

    <?php Pjax::end(); ?>

</div>
