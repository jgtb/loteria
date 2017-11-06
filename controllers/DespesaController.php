<?php

namespace app\controllers;

use Yii;
use app\models\Despesa;
use app\models\DespesaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class DespesaController extends Controller {

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
        $searchModel = new DespesaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate() {
        $model = new Despesa();
        $model->status = 1;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->data = date('Y-m-d', strtotime(str_replace('/', '-', $model->data)));
            $model->save();
            Yii::$app->session->setFlash('success', 'Despesa registrada com sucesso!');
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model->data = date('d/m/Y', strtotime($model->data));

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->data = date('Y-m-d', strtotime(str_replace('/', '-', $model->data)));
            Yii::$app->session->setFlash('success', 'Despesa alterada com sucesso!');
            $model->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    public function actionPrint($id) {
        $month = explode('/', $id)[0];
        $models = Despesa::find()
            ->joinWith('categoria')
            ->where(['MONTH(data)' => $month, 'despesa.status' => 1])
            ->orderBy(['data' => SORT_ASC, 'categoria.descricao' => SORT_ASC])
            ->asArray()
            ->all();

        $models = array_unique(array_map(function($item) { return $item['data']; }, $models));

        return $this->render('pdf', ['date' => $id, 'models' => $models]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        
        Yii::$app->session->setFlash('success', 'Despesa excluída com sucesso!');

        return $this->redirect(['index']);
    }

    protected function findModel($id) {
        if (($model = Despesa::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
