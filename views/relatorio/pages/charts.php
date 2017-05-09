<?php

use yii\helpers\Html;
use kartik\dropdown\DropdownX;
use miloschuman\highcharts\Highcharts;
?>

<div class="panel-body panel-body-chart hidden">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel-chart panel-chart-1">
                <div class="row">
                    <div class="col-lg-1">
                        <?php
                        echo Html::beginTag('div', ['class' => 'dropdown float-left']);
                        echo Html::button('<span class="glyphicon glyphicon-menu-hamburger"></span></button>', ['type' => 'button', 'class' => 'btn btn-md btn-default', 'style' => 'outline: none;', 'data-toggle' => 'dropdown']);
                        echo DropdownX::widget([
                            'items' => [
                                ['label' => 'Geral', 'url' => '#', 'linkOptions' => ['id' => 1, 'class' => 'btn-chart']],
                                ['label' => 'Comissão Jogos', 'url' => '#', 'linkOptions' => ['id' => 2, 'class' => 'btn-chart']],
                                ['label' => 'Comissão Serviços', 'url' => '#', 'linkOptions' => ['id' => 3, 'class' => 'btn-chart']],
                                ['label' => 'Receitas', 'url' => '#', 'linkOptions' => ['id' => 4, 'class' => 'btn-chart']],
                                ['label' => 'Despesas', 'url' => '#', 'linkOptions' => ['id' => 5, 'class' => 'btn-chart']],
                                ['label' => 'Lucro Mensal', 'url' => '#', 'linkOptions' => ['id' => 6, 'class' => 'btn-chart']],
                                ['label' => 'Retiradas Prolabora', 'url' => '#', 'linkOptions' => ['id' => 7, 'class' => 'btn-chart']],
                                ['label' => 'Saldo Mensal', 'url' => '#', 'linkOptions' => ['id' => 8, 'class' => 'btn-chart']],
                            ],
                        ]);
                        echo Html::endTag('div');
                        ?>
                    </div>
                    <div class="col-lg-11">
                        <?php
                        $receitaAnual = $modelRelatorio->getReceitaAnual();
                        $comissaoJogosAnual = $modelRelatorio->getComissaoJogosAnual($modelRelatorio->ano);
                        $comissaoServicosAnual = $modelRelatorio->getComissaoServicosAnual($modelRelatorio->ano);
                        $retiradasProlaboraAnual = $modelRelatorio->getRetiradasProlaboraAnual($modelRelatorio->ano);
                        $despesasAnual = $modelRelatorio->getDespesasAnual($modelRelatorio->ano);
                        ?>
                        <div class="alert alert-info text-center">
                            <div class="row">      
                                <div class="col-lg-1"><div class="panel-title">Geral</div></div>
                                <div class="col-lg-2">
                                    Jogos
                                </div>
                                <div class="col-lg-2">
                                    Serviços
                                </div>
                                <div class="col-lg-2">
                                    Prolabora
                                </div>
                                <div class="col-lg-2">
                                    Despesas
                                </div>
                                <div class="col-lg-2">
                                    Receita
                                </div>
                                <div class="col-lg-1">                        
                                    <?= Html::a('<i class="fa-2x fa fa-print"></i>', '#', ['class' => 'btn btn-xs btn-info']) ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-1"></div>
                                <div class="col-lg-2">
                                    R$ <?= number_format($comissaoJogosAnual, 2, ',', '.') ?>
                                </div>
                                <div class="col-lg-2">
                                    R$ <?= number_format($comissaoServicosAnual, 2, ',', '.') ?>
                                </div>
                                <div class="col-lg-2">
                                    R$ <?= number_format($retiradasProlaboraAnual, 2, ',', '.') ?>
                                </div>
                                <div class="col-lg-2">
                                    R$ <?= number_format($despesasAnual, 2, ',', '.') ?>
                                </div>
                                <div class="col-lg-2">
                                    R$ <?= number_format($receitaAnual, 2, ',', '.') ?>
                                </div>
                                <div class="col-lg-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                echo Highcharts::widget([
                    'options' => [
                        'title' => [
                            'text' => '',
                        ],
                        'xAxis' => [
                            'title' => [
                                'text' => '',
                            ],
                            'categories' => ['Jogos', 'Serviços', 'Prolabora', 'Despesas'],
                        ],
                        'series' => [
                            [
                                'type' => 'bar',
                                'name' => 'Geral',
                                'data' => [
                                    [
                                        'name' => 'Jogos',
                                        'y' => $modelRelatorio->getValorGraficoComissaoJogosGeral(),
                                        'color' => '#FF7F50'
                                    ],
                                    [
                                        'name' => 'Serviços',
                                        'y' => $modelRelatorio->getValorGraficoComissaoServicosGeral(),
                                        'color' => '#F0E68C'
                                    ],
                                    [
                                        'name' => 'Prolabora',
                                        'y' => $modelRelatorio->getValorGraficoRetiradasProlaboraGeral(),
                                        'color' => '#F08080'
                                    ],
                                    [
                                        'name' => 'Despesas',
                                        'y' => $modelRelatorio->getValorGraficoDespesasGeral(),
                                        'color' => '#ADD8E6'
                                    ],
                                ],
                            ]
                        ],
                        'credits' => ['enabled' => false],
                    ]
                ]);
                ?>
            </div>
        </div>
    </div>
    <?php $charts = ['Comissão Jogos', 'Comissão Serviços', 'Total Receitas', 'Total Despesas', 'Lucro Mensal', 'Retiradas Prolabora', 'Saldo Mensal'] ?>
    <?php foreach ($charts as $index => $chart) : ?>
        <div class="panel-chart panel-chart-<?= $index + 2 ?> hidden">
            <div class="row">
                <div class="col-lg-1">
                    <?php
                    echo Html::beginTag('div', ['class' => 'dropdown float-left']);
                    echo Html::button('<span class="glyphicon glyphicon-menu-hamburger"></span></button>', ['type' => 'button', 'class' => 'btn btn-md btn-default', 'style' => 'outline: none;', 'data-toggle' => 'dropdown']);
                    echo DropdownX::widget([
                        'items' => [
                            ['label' => 'Geral', 'url' => '#', 'linkOptions' => ['id' => 1, 'class' => 'btn-chart']],
                            ['label' => 'Comissão Jogos', 'url' => '#', 'linkOptions' => ['id' => 2, 'class' => 'btn-chart']],
                            ['label' => 'Comissão Serviços', 'url' => '#', 'linkOptions' => ['id' => 3, 'class' => 'btn-chart']],
                            ['label' => 'Receitas', 'url' => '#', 'linkOptions' => ['id' => 4, 'class' => 'btn-chart']],
                            ['label' => 'Despesas', 'url' => '#', 'linkOptions' => ['id' => 5, 'class' => 'btn-chart']],
                            ['label' => 'Lucro Mensal', 'url' => '#', 'linkOptions' => ['id' => 6, 'class' => 'btn-chart']],
                            ['label' => 'Retiradas Prolabora', 'url' => '#', 'linkOptions' => ['id' => 7, 'class' => 'btn-chart']],
                            ['label' => 'Saldo Mensal', 'url' => '#', 'linkOptions' => ['id' => 8, 'class' => 'btn-chart']],
                        ],
                    ]);
                    echo Html::endTag('div');
                    ?>
                </div>
                <div class="col-lg-11">
                    <div class="alert alert-info">
                        <div class="row">
                            <div class="col-lg-3"><div class="panel-title"><?= $chart ?></div></div>
                            <div class="col-lg-9"><?= Html::a('<i class="fa-2x fa fa-print"></i>', '#', ['class' => 'btn btn-xs btn-info float-right']) ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            echo Highcharts::widget([
                'options' => [
                    'title' => [
                        'text' => '',
                    ],
                    'xAxis' => [
                        'title' => [
                            'text' => '',
                        ],
                        'categories' => $mesesDescricao,
                    ],
                    'series' => [
                        [
                            'type' => 'bar',
                            'name' => $chart,
                            'size' => 10,
                            'data' => [
                                [
                                    'name' => 'Janeiro',
                                    'y' => $modelRelatorio->getValorGrafico($index, '01', $modelRelatorio->ano),
                                    'color' => '#7FFFD4'
                                ],
                                [
                                    'name' => 'Fevereiro',
                                    'y' => $modelRelatorio->getValorGrafico($index, '02', $modelRelatorio->ano),
                                    'color' => '#FF7F50'
                                ],
                                [
                                    'name' => 'Março',
                                    'y' => $modelRelatorio->getValorGrafico($index, '03', $modelRelatorio->ano),
                                    'color' => '#F0E68C'
                                ],
                                [
                                    'name' => 'Abril',
                                    'y' => $modelRelatorio->getValorGrafico($index, '04', $modelRelatorio->ano),
                                    'color' => '#F08080'
                                ],
                                [
                                    'name' => 'Maio',
                                    'y' => $modelRelatorio->getValorGrafico($index, '05', $modelRelatorio->ano),
                                    'color' => '#ADD8E6'
                                ],
                                [
                                    'name' => 'Junho',
                                    'y' => $modelRelatorio->getValorGrafico($index, '06', $modelRelatorio->ano),
                                    'color' => '#20B2AA'
                                ],
                                [
                                    'name' => 'Julho',
                                    'y' => $modelRelatorio->getValorGrafico($index, '07', $modelRelatorio->ano),
                                    'color' => '#3CB371'
                                ],
                                [
                                    'name' => 'Agosto',
                                    'y' => $modelRelatorio->getValorGrafico($index, '08', $modelRelatorio->ano),
                                    'color' => '#808000'
                                ],
                                [
                                    'name' => 'Setembro',
                                    'y' => $modelRelatorio->getValorGrafico($index, '09', $modelRelatorio->ano),
                                    'color' => '#CD853F'
                                ],
                                [
                                    'name' => 'Outubro',
                                    'y' => $modelRelatorio->getValorGrafico($index, '10', $modelRelatorio->ano),
                                    'color' => '#2E8B57'
                                ],
                                [
                                    'name' => 'Novembro',
                                    'y' => $modelRelatorio->getValorGrafico($index, '11', $modelRelatorio->ano),
                                    'color' => '#87CEEB'
                                ],
                                [
                                    'name' => 'Dezembro',
                                    'y' => $modelRelatorio->getValorGrafico(11, '12', $modelRelatorio->ano),
                                    'color' => '#4682B4'
                                ],
                            ],
                        ],
                    ],
                    'credits' => ['enabled' => false],
                ]
            ]);
            ?>
        </div>
    <?php endforeach; ?>
</div>
