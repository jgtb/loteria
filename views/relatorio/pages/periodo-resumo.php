<?php

use yii\helpers\Html;
?>
<div class="overflow-auto">
    <table class="table table-bordered table-striped table-condensed table-responsive">
        <thead class="text-center">
            <tr>
                <th>Comissão #Jogos</th>
                <th>Comissão #Serviços</th>
                <th>Total #Receitas</th>
                <th>Total #Despesas</th>
                <th>Lucro #Mensal</th>
                <th>Retiradas #Prolabora</th>
                <th>Saldo #Mensal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= number_format($modelRelatorio->getComissaoJogosPeriodo(), 2, ',', '.') ?></td>
                <td><?= number_format($modelRelatorio->getComissaoServicosPeriodo(), 2, ',', '.') ?></td>
                <td><?= number_format($modelRelatorio->getTotalReceitasPeriodo(), 2, ',', '.') ?></td>
                <td><?= number_format($modelRelatorio->getTotalDespesasPeriodo(), 2, ',', '.') ?></td>
                <td><?= number_format($modelRelatorio->getLucroMensalPeriodo(), 2, ',', '.') ?></td>
                <td><?= number_format($modelRelatorio->getRetiradasProlaboraPeriodo(), 2, ',', '.') ?></td>
                <td><?= number_format($modelRelatorio->getSaldoMensalPeriodo(), 2, ',', '.') ?></td>
            </tr>
        </tbody>
    </table>
</div>
