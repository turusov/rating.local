<?php

namespace app\models;
use yii\base\Model;

class Signup extends Model{
    public $username;
    public $password;

    public function rules(){
        return [
            [['username', 'password'], 'required'],
            ['username', 'string', 'min'=>4, 'max'=>13],
            ['username', 'unique', 'targetClass' => 'app\models\User'],
            ['password', 'string', 'min'=>3, 'max'=>13] 
        ];
    } 
    public function signup(){
        $user = new User();
        $user->username = $this->username;
        $user->setPassword($this->password);
        $user->user_status_id = 1;
        return $user->save(); //returns true or false 
    }
}