<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Jogo;

class JogoSearch extends Jogo {

    public function rules() {
        return [
            [['data', 'valor'], 'safe'],
        ];
    }

    public function scenarios() {
        return Model::scenarios();
    }

    public function search($params) {
        $query = Jogo::find()
                ->orderBy(['jogo.data' => SORT_DESC]);

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

        $query->andFilterWhere(['=', 'valor', $this->valor]);

        if ($this->data) {
            $query->andFilterWhere(['>=', 'data', date('Y-m-d', strtotime(str_replace('/', '-', '01/' . $this->data)))]);
            $query->andFilterWhere(['<=', 'data', date('Y-m-d', strtotime(str_replace('/', '-', '31/' . $this->data)))]);
        }

        return $dataProvider;
    }

}
