<?php
$dateRange = $modelRelatorio->dateRange($modelRelatorio->periodo_inicial, $modelRelatorio->periodo_final);
?>
<table class="table table-bordered table-striped table-condensed table-responsive">
    <thead>
        <tr>
            <th>Data</th>
            <th>Valor</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dateRange as $index => $date) : ?>
            <?php if ($modelRelatorio->id == 13 && in_array(date('d', strtotime($date)), [2, 12, 22]) || $modelRelatorio->id == 12) : ?>
                <tr>
                    <td><?= date('d/m/Y', strtotime($date)) ?></td>
                    <td><?= number_format($modelRelatorio->getValorDia($date), 2, ',', '.') ?></td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
        <tr>
            <td>Total / Período</td>
            <td><?= number_format($modelRelatorio->getValorTotalPeriodo(), 2, ',', '.') ?></td>
        </tr>
    </tbody>
</table>
