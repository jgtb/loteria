<table class="table table-bordered table-striped table-condensed table-responsive">
    <thead class="text-center">
        <tr>
            <th>Descrição</th>
            <th>Data</th>
            <th>Valor</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($models as $index => $date) : ?>
            <?php $despesas =  ?>
            <tr>
                <td></td>
                <td><?= date('d/m/Y', strtotime($date)) ?></td>
                <td></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td>Total</td>
        </tr>
    </tbody>
</table>

