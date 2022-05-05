<?php
namespace app\models;

use yii\base\Model;

class Login extends Model{
    public $username;
    public $password;
    
    public function rules()
    {
        return [
            ['username', 'password'], 'required',
            ['username', 'string', 'min'=>4, 'max'=>13],
            ['password', 'validatePassword']
        ];
    }
    
    public function valdiatePassword($attribute, $params)
    {
        $user = User::findOne(['email'=>$this->email]);
    }

}


?>