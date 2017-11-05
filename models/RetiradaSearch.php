<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Retirada;

class RetiradaSearch extends Retirada {

    public function rules() {
        return [
            [['retirada_id', 'status'], 'integer'],
            [['mes'], 'safe'],
            [['valor_roberto', 'valor_juliana'], 'number'],
        ];
    }

    public function scenarios() {
        return Model::scenarios();
    }

    public function search($params) {
        $query = Retirada::find()
                ->orderBy(['retirada.mes' => SORT_DESC]);
        ;

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => false
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'valor_roberto' => $this->valor_roberto,
            'valor_juliana' => $this->valor_juliana,
        ]);

        if ($this->mes)
            $query->andFilterWhere(['=', 'mes', date('Y-m-d', strtotime(str_replace('/', '-', '01/' . $this->mes)))]);

        return $dataProvider;
    }

}
