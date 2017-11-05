<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use Yii;

class Usuario extends ActiveRecord implements IdentityInterface {

    public $id;
    public $username;
    public $password;
    public $auth_key;
    public $accessToken;
    public $password_hash;
    public $password_reset_token;
    
    public static function tableName()
    {
        return 'usuario';
    }

    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['nome', 'email'], 'string', 'max' => 255],
            [['senha'], 'string', 'max' => 45],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'usuario_id' => 'Usuario ID',
            'nome' => 'Nome',
            'email' => 'E-mail',
            'senha' => 'Senha',
            'status' => 'Status',
        ];
    }
    
    public static function findIdentity($id) {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        return static::findOne(['access_token' => $token]);
    }

    public static function findByUsername($username) {
        return static::findOne(['email' => $username]);
    }

    public static function findByPasswordResetToken($token) {
        $expire = \Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        if ($timestamp + $expire < time()) {
            // token expired
            return null;
        }

        return static::findOne([
                    'password_reset_token' => $token
        ]);
    }

    public function getId() {
        return $this->getPrimaryKey();
    }

    public function getAuthKey() {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password) {
        return $this->senha === sha1($password) && $this->status == 1;
    }

    public function setPassword($password) {
        $this->password_hash = Security::generatePasswordHash($password);
    }

    public function generateAuthKey() {
        $this->auth_key = Security::generateRandomKey();
    }

    public function generatePasswordResetToken() {
        $this->password_reset_token = Security::generateRandomKey() . '_' . time();
    }

    public function removePasswordResetToken() {
        $this->password_reset_token = null;
    }
}
