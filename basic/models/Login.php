<?php
namespace app\models;

use yii\base\Model;

class Login extends Model{
    public $username;
    public $password;
    
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['username', 'string', 'min'=>4, 'max'=>13],
            ['password', 'validatePassword'] //sobstvennaia function validacii
        ];
    }
    
    public function validatePassword($attribute, $params)
    {
        if(!$this->hasErrors()){ //если нет ошибок в валидации 
            $user = $this->getUser();  //получаем пользователя для дальнейшего сравнения пароля
            if(!$user || !$user->validatePassword($this->password)) 
            {
                //если не нашли в базе такого пользователя, или пароли не равны
                $this->addError($attribute, 'Пароль или имя пользователя введены неверно'); 
                //добавляем новую ошибку для атрибута password о том что пароль или юзернейм введены неверно
            }
        }
    }
    
    public function getUser()
    {
        return User::findOne(['username'=>$this->username]); //получаем по введеному юзернейму
    }

}


?>