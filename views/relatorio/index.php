<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\Categoria;
use kartik\date\DatePicker;
use kartik\icons\Icon;
use kartik\dropdown\DropdownX;
use miloschuman\highcharts\Highcharts;

Icon::map($this);

$this->title = 'Relatórios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relatorio-index">

    <div class="row">
        <div class="col-lg-3">
            <div class="panel panel-default">
                <div class="panel-heading" style="padding: 4px;">
                    <ul class="nav nav-pills nav-justified">
                        <li class="<?= in_array($modelRelatorio->id, [NULL, 1, 2, 3, 4, 5]) ? 'active' : '' ?>"><a data-toggle="tab" href="#anual">Anual</a></li>
                        <li class="<?= in_array($modelRelatorio->id, [6]) ? 'active' : '' ?>"><a data-toggle="tab" href="#mensal">Mensal</a></li>
                        <li class="<?= in_array($modelRelatorio->id, [7]) ? 'active' : '' ?>"><a data-toggle="tab" href="#periodo">Período</a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
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
                        <div id="periodo" class="tab-pane fade <?= in_array($modelRelatorio->id, [7]) ? 'in active' : '' ?>">
                            <?php $form = ActiveForm::begin(); ?>

                            <?= $form->field($model, 'id')->dropDownList([7 => 'Despesas'], ['prompt' => 'Selecione um Relatório']) ?>

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
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <?php if ($id != NULL) : ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?php if (in_array($modelRelatorio->id, [4])) : ?>
                            <?= Html::a(Icon::show('bar-chart', ['class' => 'fa-2x']), '#', ['class' => 'btn btn-xs btn-panel-title btn-warning float-left']) ?>
                        <?php endif; ?>
                        <h1 class="panel-title text-uppercase text-center"><?= $modelRelatorio->getRelatorio(); ?></h1>
                    </div>
                    <div class="panel-body panel-body-table">
                        <?php if (in_array($modelRelatorio->id, [1, 2, 3])) : ?>
                            <table class="table table-bordered table-striped table-condensed table-responsive">
                                <thead class="text-center">
                                    <tr>
                                        <th>Dia / Mês</th>
                                        <th>JAN</th>
                                        <th>FEV</th>
                                        <th>MAR</th>
                                        <th>ABRIL</th>
                                        <th>MAIO</th>
                                        <th>JUN</th>
                                        <th>JUL</th>
                                        <th>AGO</th>
                                        <th>SET</th>
                                        <th>OUT</th>
                                        <th>NOV</th>
                                        <th>DEZ</th>
                                    </tr>
                                </thead>
                                <?php $dias = in_array($modelRelatorio->id, [1, 3]) ? [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31] : [2, 12, 22]; ?>
                                <tbody>
                                    <?php foreach ($dias as $dia) : ?>
                                        <tr>
                                            <td><?= $dia ?></td>
                                            <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&dia=<?= $dia ?>&mes=01&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValor($dia, '01'), 2, ',', '.') ?></td>
                                            <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&dia=<?= $dia ?>&mes=02&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValor($dia, '02'), 2, ',', '.') ?></td>
                                            <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&dia=<?= $dia ?>&mes=03&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValor($dia, '03'), 2, ',', '.') ?></td>
                                            <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&dia=<?= $dia ?>&mes=04&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValor($dia, '04'), 2, ',', '.') ?></td>
                                            <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&dia=<?= $dia ?>&mes=05&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValor($dia, '05'), 2, ',', '.') ?></td>
                                            <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&dia=<?= $dia ?>&mes=06&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValor($dia, '06'), 2, ',', '.') ?></td>
                                            <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&dia=<?= $dia ?>&mes=07&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValor($dia, '07'), 2, ',', '.') ?></td>
                                            <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&dia=<?= $dia ?>&mes=08&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValor($dia, '08'), 2, ',', '.') ?></td>
                                            <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&dia=<?= $dia ?>&mes=09&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValor($dia, '09'), 2, ',', '.') ?></td>
                                            <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&dia=<?= $dia ?>&mes=010&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValor($dia, '10'), 2, ',', '.') ?></td>
                                            <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&dia=<?= $dia ?>&mes=011&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValor($dia, '11'), 2, ',', '.') ?></td>
                                            <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&dia=<?= $dia ?>&mes=012&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValor($dia, '12'), 2, ',', '.') ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td>Total</td>
                                        <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&mes=01&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValorTotal('01'), 2, ',', '.') ?></td>
                                        <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&mes=02&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValorTotal('02'), 2, ',', '.') ?></td>
                                        <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&mes=03&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValorTotal('03'), 2, ',', '.') ?></td>
                                        <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&mes=04&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValorTotal('04'), 2, ',', '.') ?></td>
                                        <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&mes=05&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValorTotal('05'), 2, ',', '.') ?></td>
                                        <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&mes=06&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValorTotal('06'), 2, ',', '.') ?></td>
                                        <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&mes=07&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValorTotal('07'), 2, ',', '.') ?></td>
                                        <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&mes=08&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValorTotal('08'), 2, ',', '.') ?></td>
                                        <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&mes=09&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValorTotal('09'), 2, ',', '.') ?></td>
                                        <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&mes=10&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValorTotal('10'), 2, ',', '.') ?></td>
                                        <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&mes=11&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValorTotal('11'), 2, ',', '.') ?></td>
                                        <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&mes=12&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValorTotal('12'), 2, ',', '.') ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        <?php endif; ?>
                        <?php if (in_array($modelRelatorio->id, [4])) : ?>
                            <div style="overflow: auto;">
                                <table class="table table-bordered table-striped table-condensed table-responsive">
                                    <thead class="text-center">
                                        <tr>
                                            <th style="vertical-align: middle;">Mês</th>
                                            <th>Comissão #Jogos</th>
                                            <th>Comissão #Serviços</th>
                                            <th>Total #Receitas</th>
                                            <th>Total #Despesas</th>
                                            <th>Lucro #Mensal</th>
                                            <th>Retiradas #Prolabora</th>
                                            <th>Saldo #Mensal</th>
                                        </tr>
                                    </thead>
                                    <?php $mesesDescricao = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro']; ?>
                                    <?php $mesesValor = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12']; ?>
                                    <tbody>
                                        <?php foreach ($mesesDescricao as $index => $meseDescricao) : ?>
                                            <tr>
                                                <td><?= $meseDescricao ?></td>
                                                <td><?= number_format($modelRelatorio->getComissaoJogos($mesesValor[$index], $modelRelatorio->ano), 2, ',', '.') ?></td>
                                                <td><?= number_format($modelRelatorio->getComissaoServicos($mesesValor[$index], $modelRelatorio->ano), 2, ',', '.') ?></td>
                                                <td><?= number_format($modelRelatorio->getTotalReceitas($mesesValor[$index], $modelRelatorio->ano), 2, ',', '.') ?></td>
                                                <td><?= number_format($modelRelatorio->getTotalDespesas($mesesValor[$index], $modelRelatorio->ano), 2, ',', '.') ?></td>
                                                <td><?= number_format($modelRelatorio->getLucroMensal($mesesValor[$index], $modelRelatorio->ano), 2, ',', '.') ?></td>
                                                <td><?= number_format($modelRelatorio->getRetiradasProlabora($mesesValor[$index], $modelRelatorio->ano), 2, ',', '.') ?></td>
                                                <td><?= number_format($modelRelatorio->getSaldoMensal($mesesValor[$index], $modelRelatorio->ano), 2, ',', '.') ?></td>
                                            </tr>
                                            <?php
                                            $totalJogos += $modelRelatorio->getComissaoJogos($mesesValor[$index], $modelRelatorio->ano);
                                            $totalServicos += $modelRelatorio->getComissaoServicos($mesesValor[$index], $modelRelatorio->ano);
                                            $totalReceitas += $modelRelatorio->getTotalReceitas($mesesValor[$index], $modelRelatorio->ano);
                                            $totalDespesas += $modelRelatorio->getTotalDespesas($mesesValor[$index], $modelRelatorio->ano);
                                            $totalLucroMensal += $modelRelatorio->getLucroMensal($mesesValor[$index], $modelRelatorio->ano);
                                            $totalRetiradasProlabora += $modelRelatorio->getRetiradasProlabora($mesesValor[$index], $modelRelatorio->ano);
                                            $totalSaldoMensal += $modelRelatorio->getSaldoMensal($mesesValor[$index], $modelRelatorio->ano);
                                            ?>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td>Total</td>
                                            <td><?= number_format($totalJogos, 2, ',', '.') ?></td>
                                            <td><?= number_format($totalServicos, 2, ',', '.') ?></td>
                                            <td><?= number_format($totalReceitas, 2, ',', '.') ?></td>
                                            <td><?= number_format($totalDespesas, 2, ',', '.') ?></td>
                                            <td><?= number_format($totalLucroMensal, 2, ',', '.') ?></td>
                                            <td><?= number_format($totalRetiradasProlabora, 2, ',', '.') ?></td>
                                            <td><?= number_format($totalSaldoMensal, 2, ',', '.') ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                        <?php if (in_array($modelRelatorio->id, [5])) : ?>
                            <table class="table table-bordered table-striped table-condensed table-responsive">
                                <thead class="text-center">
                                    <tr>
                                        <th style="vertical-align: middle;">Mês</th>
                                        <th>Valor</th>
                                        <th>Roberto</th>
                                        <th>Juliana</th>
                                    </tr>
                                </thead>
                                <?php $mesesDescricao = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro']; ?>
                                <?php $mesesValor = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12']; ?>
                                <tbody>
                                    <?php foreach ($mesesDescricao as $index => $meseDescricao) : ?>
                                        <tr>
                                            <td><?= $meseDescricao ?></td>
                                            <td><?= number_format($modelRelatorio->getRetiradasProlabora($mesesValor[$index], $modelRelatorio->ano), 2, ',', '.') ?></td>
                                            <td><?= number_format($modelRelatorio->getRetiradaProlaboraRoberto($mesesValor[$index], $modelRelatorio->ano), 2, ',', '.') ?></td>
                                            <td><?= number_format($modelRelatorio->getRetiradaProlaboraJuliana($mesesValor[$index], $modelRelatorio->ano), 2, ',', '.') ?></td>
                                        </tr>
                                        <?php
                                        $total += $modelRelatorio->getRetiradasProlabora($mesesValor[$index], $modelRelatorio->ano);
                                        $totalRoberto += $modelRelatorio->getRetiradaProlaboraRoberto($mesesValor[$index], $modelRelatorio->ano);
                                        $totalJuliana += $modelRelatorio->getRetiradaProlaboraJuliana($mesesValor[$index], $modelRelatorio->ano);
                                        ?>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td>Total</td>
                                        <td><?= number_format($total, 2, ',', '.') ?></td>
                                        <td><?= number_format($totalRoberto, 2, ',', '.') ?></td>
                                        <td><?= number_format($totalJuliana, 2, ',', '.') ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        <?php endif; ?>
                        <?php if (in_array($modelRelatorio->id, [6])) : ?>
                            <?php $categorias = Categoria::find()->all() ?>
                            <?php $dias = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31]; ?>
                            <?php $diasSQL = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31'] ?>
                            <table class="table table-bordered table-striped table-condensed table-responsive">
                                <thead>
                                    <tr>
                                        <th>Dias / Categorias</th>
                                        <?php foreach ($categorias as $categoria) : ?>
                                            <th><?= $categoria->descricao ?></th>
                                        <?php endforeach; ?>
                                        <th>Total / Dia</th>
                                        <th>Total / Mês</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($dias as $index => $dia) : ?>
                                        <tr>
                                            <td><?= $dia ?></td>
                                            <?php foreach ($categorias as $categoria) : ?>
                                                <td class="td-hover td-modal" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&dia=<?= $diasSQL[$index] ?>&mes=<?= date('m', strtotime($modelRelatorio->mes_ano)) ?>&ano=<?= date('Y', strtotime($modelRelatorio->mes_ano)) ?>&categoriaID=<?= $categoria->categoria_id ?>"><?= number_format($modelRelatorio->getValorDespesaDia($diasSQL[$index], $categoria->categoria_id), 2, ',', '.') ?></td>
                                            <?php endforeach; ?>
                                            <td class="td-hover td-modal" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&dia=<?= $diasSQL[$index] ?>&mes=<?= date('m', strtotime($modelRelatorio->mes_ano)) ?>&ano=<?= date('Y', strtotime($modelRelatorio->mes_ano)) ?>"><?= number_format($modelRelatorio->getValorDespesaTotalDia($diasSQL[$index]), 2, ',', '.') ?></td>
                                            <?php if ($index == 0) : ?>
                                                <td class="td-hover td-modal" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&mes=<?= date('m', strtotime($modelRelatorio->mes_ano)) ?>&ano=<?= date('Y', strtotime($modelRelatorio->mes_ano)) ?>"><?= number_format($modelRelatorio->getValorDespesaTotalMes(), 2, ',', '.') ?></td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>  
                        <?php endif; ?>
                        <?php if (in_array($modelRelatorio->id, [7])) : ?>
                            <?php $categorias = Categoria::find()->all() ?>
                            <table class="table table-bordered table-striped table-condensed table-responsive">
                                <tbody>
                                <thead class="text-center">
                                    <tr>
                                        <th>Categoria</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                </thead>
                                <?php foreach ($categorias as $categoria) : ?>
                                    <tr>
                                        <td style="width: 30%;"><?= $categoria->descricao ?></td>
                                        <td class="td-hover td-modal" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&categoriaID=<?= $categoria->categoria_id ?>&periodoInicial=<?= $modelRelatorio->periodo_inicial ?>&periodoFinal=<?= $modelRelatorio->periodo_final ?>">R$ <?= number_format($modelRelatorio->getTotalDespesaPeriodo($categoria->categoria_id), 2, ',', '.') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>
                    <?php if (in_array($modelRelatorio->id, [4])) : ?>
                        <div class="panel-body panel-body-chart hidden">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel panel-default panel-chart panel-chart-1">
                                        <div class="panel-heading">
                                            <?php
                                            echo Html::beginTag('div', ['class' => 'dropdown float-left', 'style' => 'margin-top: -6px;']);
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
                                            <div class="panel-title text-center">Gráfico Geral em %</div>
                                        </div>
                                        <div class="panel-body">
                                            <?php
                                            $receitaAnual = $modelRelatorio->getReceitaAnual();
                                            $comissaoJogosAnual = $modelRelatorio->getComissaoJogosAnual($modelRelatorio->ano);
                                            $comissaoServicosAnual = $modelRelatorio->getComissaoServicosAnual($modelRelatorio->ano);
                                            $retiradasProlaboraAnual = $modelRelatorio->getRetiradasProlaboraAnual($modelRelatorio->ano);
                                            $despesasAnual = $modelRelatorio->getDespesasAnual($modelRelatorio->ano);
                                            ?>
                                            <div class="alert alert-info text-center">
                                                <div class="row">      
                                                    <div class="col-lg-1"></div>
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
                                                    <div class="col-lg-1"></div>
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
                            </div>
                            <?php $charts = ['Comissão Jogos', 'Comissão Serviços', 'Total Receitas', 'Total Despesas', 'Lucro Mensal', 'Retiradas Prolabora', 'Saldo Mensal'] ?>
                            <?php foreach ($charts as $index => $chart) : ?>
                                <div class="col-lg-12">
                                    <div class="panel panel-default panel-chart panel-chart-<?= $index + 2 ?> hidden">
                                        <div class="panel-heading">
                                            <?php
                                            echo Html::beginTag('div', ['class' => 'dropdown float-left', 'style' => 'margin-top: -6px;']);
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
                                            <div class="panel-title text-center">
                                                Gráfico <?= $chart ?> em R$
                                            </div>
                                        </div>
                                        <div class="panel-body">
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
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="modal-copy"></div>

</div>

<script type="text/javascript" src="<?= Yii::$app->request->baseUrl . '/js/jquery-1.9.1.min.js' ?>"></script>
<script type="text/javascript">
    $(document).ready(function () {

        $('.btn-panel-title').on('click', function () {
            var icon = $(this).find('i');
            if (icon.hasClass('fa-bar-chart')) {
                icon.removeClass('fa-bar-chart').addClass('fa-table');
                $('.panel-body-table').addClass('hidden');
                $('.panel-body-chart').removeClass('hidden');
            } else {
                icon.removeClass('fa-table').addClass('fa-bar-chart');
                $('.panel-body-table').removeClass('hidden');
                $('.panel-body-chart').addClass('hidden');
            }
        });

        $('.btn-chart').on('click', function () {
            $('.panel-chart').each(function () {
                $(this).addClass('hidden');
            });
            0
            $('.panel-chart-' + $(this).attr('id') + '').removeClass('hidden');
        });

        $('.td-modal').on('click', function (e) {
            e.preventDefault();
            $.ajax({url: $(this).data('url'), success: function (modal) {
                    $('.modal-copy').html(modal);
                }}).done(function () {
                $('#modal').modal('show');
            });
        });

    });

</script>
