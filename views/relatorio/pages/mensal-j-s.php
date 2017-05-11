<?php

use yii\helpers\Html;

$dias = in_array($modelRelatorio->id, [8]) ? [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31] : [2, 12, 22];
?>
<table class="table table-bordered table-striped table-condensed table-responsive">
    <thead>
        <tr>
            <th>Dias</th>
            <th>Valor</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dias as $index => $dia) : ?>
            <tr>
                <td><?= $dia ?></td>
                <td><?= number_format($modelRelatorio->getValorMensalJS($dia), 2, ',', '.') ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td>Total / Mês</td>
            <td><?= number_format($modelRelatorio->getValorMensalTotalJS(), 2, ',', '.') ?></td>
        </tr>
    </tbody>
</table>  
