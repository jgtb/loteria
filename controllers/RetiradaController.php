<?php

namespace app\controllers;

use Yii;
use app\models\Retirada;
use app\models\RetiradaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class RetiradaController extends Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex() {
        $searchModel = new RetiradaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate() {
        $model = new Retirada();
        $model->status = 1;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->mes = date('Y-m-d', strtotime(str_replace('/', '-', '01/' . $model->mes)));
            $model->save();
            Yii::$app->session->setFlash('success', 'Retirada registrada com sucesso!');
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model->mes = date('m/Y', strtotime($model->mes));

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->data = date('Y-m-d', strtotime(str_replace('/', '-', $model->data)));
            Yii::$app->session->setFlash('success', 'Retirada alterada com sucesso!');
            $model->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    public function actionDelete($id) {
        $this->findModel($id)->delete();

        Yii::$app->session->setFlash('success', 'Retirada excluída com sucesso!');

        return $this->redirect(['index']);
    }

    protected function findModel($id) {
        if (($model = Retirada::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
