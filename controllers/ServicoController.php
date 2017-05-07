<?php

namespace app\controllers;

use Yii;
use app\models\Servico;
use app\models\ServicoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class ServicoController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new ServicoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Servico();
        $model->status = 1;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->data = date('Y-m-d', strtotime(str_replace('/', '-', $model->data)));
            $model->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->data = date('d/m/Y', strtotime($model->data));

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->data = date('Y-m-d', strtotime(str_replace('/', '-', $model->data)));
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Servico::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
