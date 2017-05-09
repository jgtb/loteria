<?php
$dateRange = $modelRelatorio->dateRange($modelRelatorio->periodo_inicial, $modelRelatorio->periodo_final);
?>
<table class="table table-bordered table-striped table-condensed table-responsive">
    <thead>
        <tr>
            <th>Data</th>
            <th>Valor</th>
            <th>Total Período</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dateRange as $index => $date) : ?>
            <tr>
                <td><?= date('d/m/Y', strtotime($date)) ?></td>
                <td><?= number_format($modelRelatorio->getValorDia($date), 2, ',', '.') ?></td>
                <?php if ($index == 0) : ?>
                    <td><?= number_format($modelRelatorio->getValorTotalPeriodo(), 2, ',', '.') ?></td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
