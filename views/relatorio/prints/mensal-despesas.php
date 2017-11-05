<?php

use yii\helpers\Html;
use app\models\Categoria;

$categorias = Categoria::find()->all();
$dias = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31];
$diasSQL = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31'];
?>

<table class="table table-bordered table-striped table-condensed table-responsive">
    <thead>
        <tr>
            <th class="text-center">Dia<br>Categoria</th>
            <?php foreach ($dias as $index => $dia) : ?>
                <th><?= $dia ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categorias as $categoria) : ?>
            <tr>
                <td><?= $categoria->descricao ?></td>
                <?php foreach ($dias as $index => $dia) : ?>
                    <td><?= number_format($modelRelatorio->getValorDespesaDia($dia, $categoria->categoria_id)) ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
            <tr>
                <td>Total / Dia</td>
                <?php foreach ($dias as $index => $dia) : ?>
                    <td><?= number_format($modelRelatorio->getValorDespesaTotalDia($dia)) ?></td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <td>Total / Mês</td>
                <td><?= number_format($modelRelatorio->getValorDespesaTotalMes()) ?></td>
            </tr>
    </tbody>
</table>