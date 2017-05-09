<table class="table table-bordered table-striped table-condensed table-responsive">
    <thead>
        <tr>
            <th>Valor</th>
            <th>Roberto</th>
            <th>Juliana</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?= number_format($modelRelatorio->getRetiradasProlabora(date('m', strtotime($modelRelatorio->mes_ano)), date('Y', strtotime($modelRelatorio->mes_ano))), 2, ',', '.') ?></td>
            <td><?= number_format($modelRelatorio->getRetiradaProlaboraRoberto(date('m', strtotime($modelRelatorio->mes_ano)), date('Y', strtotime($modelRelatorio->mes_ano))), 2, ',', '.') ?></td>
            <td><?= number_format($modelRelatorio->getRetiradaProlaboraJuliana(date('m', strtotime($modelRelatorio->mes_ano)), date('Y', strtotime($modelRelatorio->mes_ano))), 2, ',', '.') ?></td>
        </tr>
    </tbody>
</table>  