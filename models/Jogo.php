<?php

namespace app\models;

use Yii;

class Jogo extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'jogo';
    }

    public function rules()
    {
        return [
            [['valor', 'data'], 'required', 'message' => 'Campo obrigatório'],
            [['data'], 'safe'],
            [['valor'], 'number'],
            [['status'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'jogo_id' => 'Jogo ID',
            'data' => 'Data',
            'valor' => 'Valor',
            'status' => 'Status',
        ];
    }
}
