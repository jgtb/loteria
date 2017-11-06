<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
?>  

<?php
Modal::begin([
    'id' => 'modal',
    'size' => Modal::SIZE_DEFAULT
]);
?>

<?php if ($modelsDespesa) : ?>
    <h4 class="modal-title text-center m-b-10"><?= $model->getDataModal($dia, $mes, $ano, $periodoInicial, $periodoFinal); ?></h4>
    <table class="table table-striped table-bordered table-condensed table-responsive">
        <thead>
            <tr>
                <th>Categoria</th>
                <th>Data</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($modelsDespesa as $modelDespesa) : ?>
                <tr>
                    <td><?= $modelDespesa->categoria->descricao ?></td>
                    <td><?= date('d/m/Y', strtotime($modelDespesa->data)) ?></td>
                    <td>R$ <?= number_format($modelDespesa->valor, 2, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php if (!$modelsDespesa) : ?> <h4 class="modal-title text-center">Nenhum resultado encontrado.</h4> <?php endif; ?>

<?php Modal::end(); ?>


