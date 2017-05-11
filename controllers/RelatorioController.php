<?php

namespace app\controllers;

use Yii;
use app\models\Relatorio;
use app\models\Despesa;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class RelatorioController extends Controller {

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

    public function actionIndex($id = NULL) {
        $model = new Relatorio();

        $modelRelatorio = Relatorio::findOne(['relatorio_id' => $id]);
        $model->id = $modelRelatorio->id;
        $model->ano = $modelRelatorio->ano;
        $model->mes_ano = $modelRelatorio->mes_ano;
        $model->periodo_inicial = $modelRelatorio->periodo_inicial;
        $model->periodo_final = $modelRelatorio->periodo_final;

        if (in_array($modelRelatorio->id, [1, 2, 3, 4, 5])) {
            $model->ano = date('Y', strtotime($model->ano . '-01-01'));
        }

        if (in_array($modelRelatorio->id, [6, 8, 9, 10, 11])) {
            $model->mes_ano = date('m/Y', strtotime($model->mes_ano));
        }

        if (in_array($modelRelatorio->id, [7, 12, 13, 14, 15])) {
            $model->periodo = date('d/m/Y', strtotime($model->periodo_inicial));
            $model->periodo_final = date('d/m/Y', strtotime($model->periodo_final));
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            if (in_array($model->id, [1, 2, 3, 4, 5])) {
                $model->ano = date('Y-m-d', strtotime(str_replace('/', '-', '01/01/' . $model->ano)));
                $model->mes_ano = NULL;
                $model->periodo_inicial = NULL;
                $model->periodo_final = NULL;
            }

            if (in_array($model->id, [6, 8, 9, 10, 11])) {
                $model->mes_ano = date('Y-m-d', strtotime(str_replace('/', '-', '01/' . $model->mes_ano)));
                $model->ano = NULL;
                $model->periodo_inicial = NULL;
                $model->periodo_final = NULL;
            }

            if (in_array($model->id, [7, 12, 13, 14, 15])) {
                $model->periodo_inicial = date('Y-m-d', strtotime(str_replace('/', '-', $model->periodo)));
                $model->periodo_final = date('Y-m-d', strtotime(str_replace('/', '-', $model->periodo_final)));
                $model->mes_ano = NULL;
                $model->ano = NULL;
            }

            $model->save(false);
            return $this->redirect(['index', 'id' => $model->relatorio_id]);
        } else {
            return $this->render('index', [
                        'model' => $model,
                        'modelRelatorio' => $modelRelatorio,
                        'id' => $id,
            ]);
        }
    }
    
    public function actionModal($id, $dia = NULL, $mes = NULL, $ano = NULL, $categoriaID = NULL, $periodoInicial = NULL, $periodoFinal = NULL) {

        if ($dia != NULL)
            $modelsDespesa = Despesa::find()->joinWith('categoria')->where(['DAY(data)' => $dia, 'MONTH(data)' => $mes, 'YEAR(data)' => $ano])->orderBy(['categoria.descricao' => SORT_ASC, 'despesa.data' => SORT_ASC])->all();

        if ($dia == NULL)
            $modelsDespesa = Despesa::find()->joinWith('categoria')->where(['MONTH(data)' => $mes, 'YEAR(data)' => $ano])->orderBy(['categoria.descricao' => SORT_ASC, 'despesa.data' => SORT_ASC])->all();

        if ($categoriaID != NULL)
            $modelsDespesa = Despesa::find()->joinWith('categoria')->where(['DAY(data)' => $dia, 'MONTH(data)' => $mes, 'YEAR(data)' => $ano, 'despesa.categoria_id' => $categoriaID])->orderBy(['categoria.descricao' => SORT_ASC, 'despesa.data' => SORT_ASC])->all();

        if ($periodoInicial != NULL && $periodoFinal != NULL)
            $modelsDespesa = Despesa::find()->joinWith('categoria')->where(['>=', 'DATE(data)', $periodoInicial])->andWhere(['<=', 'DATE(data)', $periodoFinal])->andWhere(['despesa.categoria_id' => $categoriaID])->orderBy(['categoria.descricao' => SORT_ASC, 'despesa.data' => SORT_ASC])->all();

        $model = new Relatorio();
        return $this->renderAjax('modal', ['model' => $model, 'modelsDespesa' => $modelsDespesa, 'dia' => $dia, 'mes' => $mes, 'ano' => $ano, 'periodoInicial' => $periodoInicial, 'periodoFinal' => $periodoFinal]);
    }
    
    public function actionPdf($id) {
        $model = $this->findModel($id);
        
        return $this->render('pdf', [
                    'model' => $model,
        ]);
    }

    protected function findModel($id) {
        if (($model = Relatorio::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
