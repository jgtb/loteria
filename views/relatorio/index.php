<?php

use yii\helpers\Html;
use kartik\icons\Icon;

Icon::map($this);

$this->title = 'Relatórios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relatorio-index">

    <div class="row">
        <div class="col-lg-3">
            <div class="panel panel-default">
                <div class="panel-heading padding-4">
                    <ul class="nav nav-pills nav-justified">
                        <li class="<?= in_array($modelRelatorio->id, [NULL, 1, 2, 3, 4, 5]) ? 'active' : '' ?>"><a data-toggle="tab" href="#anual">Anual</a></li>
                        <li class="<?= in_array($modelRelatorio->id, [6, 8, 9, 10, 11]) ? 'active' : '' ?>"><a data-toggle="tab" href="#mensal">Mensal</a></li>
                        <li class="<?= in_array($modelRelatorio->id, [7, 12, 13, 14, 15]) ? 'active' : '' ?>"><a data-toggle="tab" href="#periodo">Período</a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <?php echo $this->render('forms/anual', ['model' => $model, 'modelRelatorio' => $modelRelatorio]); ?>
                        <?php echo $this->render('forms/mensal', ['model' => $model, 'modelRelatorio' => $modelRelatorio]); ?>
                        <?php echo $this->render('forms/periodo', ['model' => $model, 'modelRelatorio' => $modelRelatorio]); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <?php if ($id != NULL) : ?>
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-main">
                        <?= Html::a(Icon::show('print', ['class' => 'fa-2x']), '#', ['class' => 'btn btn-xs btn-panel-title-print btn-info float-right']) ?>
                        <?php if (in_array($modelRelatorio->id, [4])) : ?>
                            <?= Html::a(Icon::show('bar-chart', ['class' => 'fa-2x']), '#', ['class' => 'btn btn-xs btn-panel-title btn-warning float-left']) ?>
                        <?php endif; ?>
                        <h1 class="panel-title text-uppercase text-center"><?= $modelRelatorio->getRelatorio(); ?></h1>
                    </div>
                    <div class="panel-body panel-body-table">
                        <h1 class="panel-title m-b-10"><?= $modelRelatorio->getRelatorioData() ?> <span class="fa fa-calendar"></span></h1>
                        <?php if (in_array($modelRelatorio->id, [1, 2, 3])) : ?>
                            <?php echo $this->render('pages/anual-j-s-d', ['modelRelatorio' => $modelRelatorio]); ?>
                        <?php endif; ?>
                        <?php if (in_array($modelRelatorio->id, [4])) : ?>
                            <?php echo $this->render('pages/anual-resumo', ['modelRelatorio' => $modelRelatorio]); ?>
                        <?php endif; ?>
                        <?php if (in_array($modelRelatorio->id, [5])) : ?>
                            <?php echo $this->render('pages/anual-retiradas', ['modelRelatorio' => $modelRelatorio]); ?>
                        <?php endif; ?>
                        <?php if (in_array($modelRelatorio->id, [6])) : ?>
                            <?php echo $this->render('pages/mensal-despesas', ['modelRelatorio' => $modelRelatorio]); ?>
                        <?php endif; ?>
                        <?php if (in_array($modelRelatorio->id, [8, 9])) : ?>
                            <?php echo $this->render('pages/mensal-j-s', ['modelRelatorio' => $modelRelatorio]); ?>
                        <?php endif; ?>
                        <?php if (in_array($modelRelatorio->id, [10])) : ?>
                            <?php echo $this->render('pages/mensal-retiradas', ['modelRelatorio' => $modelRelatorio]); ?>
                        <?php endif; ?>
                        <?php if (in_array($modelRelatorio->id, [11])) : ?>
                            <?php echo $this->render('pages/mensal-resumo', ['modelRelatorio' => $modelRelatorio]); ?>
                        <?php endif; ?>
                        <?php if (in_array($modelRelatorio->id, [7])) : ?>
                            <?php echo $this->render('pages/periodo-despesas', ['modelRelatorio' => $modelRelatorio]); ?>
                        <?php endif; ?>
                        <?php if (in_array($modelRelatorio->id, [12, 13])) : ?>
                            <?php echo $this->render('pages/periodo-j-s', ['modelRelatorio' => $modelRelatorio]); ?>
                        <?php endif; ?>
                        <?php if (in_array($modelRelatorio->id, [14])) : ?>
                            <?php echo $this->render('pages/periodo-retiradas', ['modelRelatorio' => $modelRelatorio]); ?>
                        <?php endif; ?>
                        <?php if (in_array($modelRelatorio->id, [15])) : ?>
                            <?php echo $this->render('pages/periodo-resumo', ['modelRelatorio' => $modelRelatorio]); ?>
                        <?php endif; ?>
                    </div>
                    <?php if (in_array($modelRelatorio->id, [4])) : ?>
                        <?php echo $this->render('pages/charts', ['modelRelatorio' => $modelRelatorio]); ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="modal-copy"></div>

</div>

<script type="text/javascript" src="<?= Yii::$app->request->baseUrl . '/js/jquery-1.9.1.min.js' ?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.btn-panel-title').on('click', function () {
            var icon = $(this).find('i');
            if (icon.hasClass('fa-bar-chart')) {
                icon.removeClass('fa-bar-chart').addClass('fa-table');
                $('.panel-body-table').addClass('hidden');
                $('.btn-panel-title-print').addClass('hidden');
                $('.panel-body-chart').removeClass('hidden');
            } else {
                icon.removeClass('fa-table').addClass('fa-bar-chart');
                $('.panel-body-table').removeClass('hidden');
                $('.btn-panel-title-print').removeClass('hidden');
                $('.panel-body-chart').addClass('hidden');
            }
        });

        $('.btn-chart').on('click', function () {
            $('.panel-chart').each(function () {
                $(this).addClass('hidden');
            });
            $('.panel-chart-' + $(this).attr('id') + '').removeClass('hidden');
        });

        $('.td-modal').on('click', function (e) {
            e.preventDefault();
            $.ajax({url: $(this).data('url'), success: function (modal) {
                    $('.modal-copy').html(modal);
                }}).done(function () {
                $('#modal').modal('show');
            });
        });

    });
</script>
