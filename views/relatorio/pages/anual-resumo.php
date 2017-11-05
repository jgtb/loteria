<?php

use yii\helpers\Html;
?>
<div class="overflow-auto">
    <table class="table table-bordered table-striped table-condensed table-responsive">
        <thead class="text-center">
            <tr>
                <th>Mês</th>
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
