<table class="table table-bordered table-striped table-condensed table-responsive">
    <thead class="text-center">
        <tr>
            <th>Dia / Mês</th>
            <th>JAN</th>
            <th>FEV</th>
            <th>MAR</th>
            <th>ABRIL</th>
            <th>MAIO</th>
            <th>JUN</th>
            <th>JUL</th>
            <th>AGO</th>
            <th>SET</th>
            <th>OUT</th>
            <th>NOV</th>
            <th>DEZ</th>
        </tr>
    </thead>
    <?php $dias = in_array($modelRelatorio->id, [1, 3]) ? [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31] : [2, 12, 22]; ?>
    <tbody>
        <?php foreach ($dias as $dia) : ?>
            <tr>
                <td><?= $dia ?></td>
                <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&dia=<?= $dia ?>&mes=01&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValor($dia, '01'), 2, ',', '.') ?></td>
                <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&dia=<?= $dia ?>&mes=02&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValor($dia, '02'), 2, ',', '.') ?></td>
                <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&dia=<?= $dia ?>&mes=03&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValor($dia, '03'), 2, ',', '.') ?></td>
                <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&dia=<?= $dia ?>&mes=04&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValor($dia, '04'), 2, ',', '.') ?></td>
                <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&dia=<?= $dia ?>&mes=05&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValor($dia, '05'), 2, ',', '.') ?></td>
                <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&dia=<?= $dia ?>&mes=06&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValor($dia, '06'), 2, ',', '.') ?></td>
                <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&dia=<?= $dia ?>&mes=07&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValor($dia, '07'), 2, ',', '.') ?></td>
                <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&dia=<?= $dia ?>&mes=08&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValor($dia, '08'), 2, ',', '.') ?></td>
                <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&dia=<?= $dia ?>&mes=09&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValor($dia, '09'), 2, ',', '.') ?></td>
                <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&dia=<?= $dia ?>&mes=010&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValor($dia, '10'), 2, ',', '.') ?></td>
                <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&dia=<?= $dia ?>&mes=011&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValor($dia, '11'), 2, ',', '.') ?></td>
                <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&dia=<?= $dia ?>&mes=012&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValor($dia, '12'), 2, ',', '.') ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td>Total</td>
            <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&mes=01&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValorTotal('01'), 2, ',', '.') ?></td>
            <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&mes=02&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValorTotal('02'), 2, ',', '.') ?></td>
            <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&mes=03&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValorTotal('03'), 2, ',', '.') ?></td>
            <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&mes=04&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValorTotal('04'), 2, ',', '.') ?></td>
            <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&mes=05&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValorTotal('05'), 2, ',', '.') ?></td>
            <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&mes=06&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValorTotal('06'), 2, ',', '.') ?></td>
            <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&mes=07&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValorTotal('07'), 2, ',', '.') ?></td>
            <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&mes=08&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValorTotal('08'), 2, ',', '.') ?></td>
            <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&mes=09&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValorTotal('09'), 2, ',', '.') ?></td>
            <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&mes=10&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValorTotal('10'), 2, ',', '.') ?></td>
            <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&mes=11&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValorTotal('11'), 2, ',', '.') ?></td>
            <td class="<?= $modelRelatorio->id == 3 ? 'td-modal td-hover' : '' ?>" data-url="<?= Yii::$app->homeUrl ?>relatorio/modal?id=<?= $modelRelatorio->id ?>&mes=12&ano=<?= $modelRelatorio->ano ?>"><?= number_format($modelRelatorio->getValorTotal('12'), 2, ',', '.') ?></td>
        </tr>
    </tbody>
</table>