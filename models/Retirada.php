<?php

namespace app\models;

use Yii;

class Retirada extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'retirada';
    }

    public function rules()
    {
        return [
            [['mes', 'valor_roberto', 'valor_juliana'], 'required', 'message' => 'Campo obrigatório'],
            [['mes'], 'safe'],
            [['valor_roberto', 'valor_juliana'], 'number'],
            [['status'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'retirada_id' => 'Retirada ID',
            'mes' => 'Mês',
            'valor_roberto' => 'Roberto',
            'valor_juliana' => 'Juliana',
            'status' => 'Status',
        ];
    }

    public function getMes() {
      $meses = ['', 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Nobembro', 'Dezembro'];

      return $meses[(int) date('m', strtotime($this->mes))];
    }

    public function getTotal() {
      return number_format($this->valor_roberto + $this->valor_juliana, 2, ',', '.');
    }
}
