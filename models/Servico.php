<?php

namespace app\models;

use Yii;

class Servico extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'servico';
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
            'servico_id' => 'Servico ID',
            'data' => 'Data',
            'valor' => 'Valor',
            'status' => 'Status',
        ];
    }
}
