<?php

namespace app\models;

use Yii;

class Despesa extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'despesa';
    }

    public function rules()
    {
        return [
            [['categoria_id', 'valor', 'data'], 'required', 'message' => 'Campo obrigatório'],
            [['categoria_id', 'status'], 'integer'],
            [['valor'], 'double'],
            [['data'], 'safe'],
            [['categoria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::className(), 'targetAttribute' => ['categoria_id' => 'categoria_id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'despesa_id' => 'Despesa ID',
            'categoria_id' => 'Categoria',
            'valor' => 'Valor',
            'data' => 'Data',
            'status' => 'Status',
        ];
    }

    public function getCategoria()
    {
        return $this->hasOne(Categoria::className(), ['categoria_id' => 'categoria_id']);
    }
}
