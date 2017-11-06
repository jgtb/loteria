<?php

use app\models\Categoria;
?>

<?php $categorias = Categoria::find()->where(['status' => 1])->orderBy(['descricao' => SORT_ASC])->all() ?>
<table class="table table-bordered table-striped table-condensed table-responsive">
    <thead class="text-center">
        <tr>
            <th>Categoria</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categorias as $categoria) : ?>
            <tr>
                <td><?= $categoria->descricao ?></td>
                <td class="td-hover td-modal" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&categoriaID=<?= $categoria->categoria_id ?>&periodoInicial=<?= $modelRelatorio->periodo_inicial ?>&periodoFinal=<?= $modelRelatorio->periodo_final ?>">R$ <?= number_format($modelRelatorio->getTotalDespesaPeriodo($categoria->categoria_id), 2, ',', '.') ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>