<?php

use yii\helpers\Html;
use app\models\Categoria;
?>

<?php $categorias = Categoria::find()->all() ?>
<?php $dias = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31]; ?>
<?php $diasSQL = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31'] ?>
<div style="overflow: auto;">
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
</div>