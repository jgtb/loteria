<table class="table table-bordered table-striped table-condensed table-responsive">
    <thead>
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
            <td><?= number_format($modelRelatorio->getComissaoJogos(date('m', strtotime($modelRelatorio->mes_ano)), date('Y', strtotime($modelRelatorio->mes_ano))), 2, ',', '.') ?></td>
            <td><?= number_format($modelRelatorio->getComissaoServicos(date('m', strtotime($modelRelatorio->mes_ano)), date('Y', strtotime($modelRelatorio->mes_ano))), 2, ',', '.') ?></td>
            <td><?= number_format($modelRelatorio->getTotalReceitas(date('m', strtotime($modelRelatorio->mes_ano)), date('Y', strtotime($modelRelatorio->mes_ano))), 2, ',', '.') ?></td>
            <td><?= number_format($modelRelatorio->getTotalDespesas(date('m', strtotime($modelRelatorio->mes_ano)), date('Y', strtotime($modelRelatorio->mes_ano))), 2, ',', '.') ?></td>
            <td><?= number_format($modelRelatorio->getLucroMensal(date('m', strtotime($modelRelatorio->mes_ano)), date('Y', strtotime($modelRelatorio->mes_ano))), 2, ',', '.') ?></td>
            <td><?= number_format($modelRelatorio->getRetiradasProlabora(date('m', strtotime($modelRelatorio->mes_ano)), date('Y', strtotime($modelRelatorio->mes_ano))), 2, ',', '.') ?></td>
            <td><?= number_format($modelRelatorio->getSaldoMensal(date('m', strtotime($modelRelatorio->mes_ano)), date('Y', strtotime($modelRelatorio->mes_ano))), 2, ',', '.') ?></td>
        </tr>
    </tbody>
</table>  
