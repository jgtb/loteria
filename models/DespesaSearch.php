<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Despesa;

class DespesaSearch extends Despesa {

    public function rules() {
        return [
            [['categoria_id', 'valor', 'data'], 'safe'],
        ];
    }

    public function scenarios() {
        return Model::scenarios();
    }

    public function search($params) {
        $query = Despesa::find()
                ->joinWith('categoria')
                ->orderBy(['despesa.data' => SORT_DESC, 'categoria.descricao' => SORT_ASC]);

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

        $query->andFilterWhere(['=', 'despesa.categoria_id', $this->categoria_id])
                ->andFilterWhere(['=', 'despesa.valor', $this->valor]);
                
        if ($this->data) 
            $query->andFilterWhere(['=', 'MONTH(data)', date('m', strtotime(str_replace('/', '-', '01/' . $this->data)))]);
            
        return $dataProvider;
    }

}
