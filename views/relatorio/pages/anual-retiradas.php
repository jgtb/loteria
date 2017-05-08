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