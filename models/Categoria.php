<?php

namespace app\models;

use Yii;

class Categoria extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'categoria';
    }

    public function rules()
    {
        return [
            [['descricao'], 'string', 'max' => 225, 'message' => 'Campo obrigatório'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'categoria_id' => 'Categoria ID',
            'descricao' => 'Descrição',
        ];
    }

    public function getDespesas()
    {
        return $this->hasMany(Despesa::className(), ['categoria_id' => 'categoria_id']);
    }
}
