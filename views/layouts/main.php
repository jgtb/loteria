<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii2mod\alert\Alert;
use yii2mod\alert\AlertAsset;
use app\assets\AppAsset;
use kartik\icons\Icon;

Icon::map($this);

AppAsset::register($this);
AlertAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => 'LOT',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav'],
                'items' => [
                    ['label' => 'Jogos', 'url' => ['/jogo'], 'options' => ['class' => Yii::$app->controller->id == 'jogo' ? 'active' : '']],
                    ['label' => 'Serviços', 'url' => ['/servico'], 'options' => ['class' => Yii::$app->controller->id == 'servico' ? 'active' : '']],
                    ['label' => 'Despesa', 'options' => ['class' => Yii::$app->controller->id == 'despesa' || Yii::$app->controller->id == 'categoria' ? 'active' : ''], 'items' => [
                            ['label' => 'Categorias', 'url' => ['/categoria'], 'options' => ['class' => Yii::$app->controller->id == 'categoria' ? 'active' : '']],
                            ['label' => 'Despesas', 'url' => ['/despesa'], 'options' => ['class' => Yii::$app->controller->id == 'despesa' ? 'active' : '']]
                        ]],
                    ['label' => 'Retiradas', 'url' => ['/retirada'], 'options' => ['class' => Yii::$app->controller->id == 'retirada' ? 'active' : '']],
                    ['label' => 'Relatórios', 'url' => ['/relatorio'], 'options' => ['class' => Yii::$app->controller->id == 'relatorio' ? 'active' : '']],
                    [
                        'label' => 'LOT',
                        'items' => [
                            ['label' => 'LOT Jogos', 'url' => '/loteria_jogo/web'],
                            //['label' => 'CR.CP', 'url' => '/crcp/web'],
                        ],
                    ]
                ],
            ]);
            NavBar::end();
            ?>

            <div class="container">
                <?=
                Breadcrumbs::widget([
                    'homeLink' => ['label' => 'LOT', 'url' => ['/site/index']],
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <?php echo Alert::widget(); ?>
                <?= $content ?>
            </div>
        </div>
        
        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; LOT</p>

                <p class="pull-right"><?= date('Y') ?></p>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>