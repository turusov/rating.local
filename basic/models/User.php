<?php
namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use app\models\UserStatus;
class User extends ActiveRecord implements IdentityInterface
{
    public static function tableName()
    {
        return 'user';
    }
    public function rules()
    {
        /*
        return [
            [['username', 'password', 'user_status_id'], 'required'],
            [['user_status_id'], 'integer'],
            [['username'], 'string', 'max' => 25],
            [['password', 'auth_key'], 'string', 'max' => 255],
            [['user_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserStatus::className(), 'targetAttribute' => ['user_status_id' => 'id']],
        ];
        return [ 
            [['username','password'], 'required'],
            [['user_status_id'], 'default','value'=>2],
        ];
        */
        return [
            [['username', 'password', 'user_status_id'], 'required'],
            [['id', 'user_status_id'], 'integer'],
            [['username', 'password'], 'string', 'max' => 100],
            
        ];
    }

    /**
     * Finds an identity by the given ID.
     *
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return bool if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
    

    public function setPassword($password){
        $this->password = sha1($password);
    }
    
    public function getPassword(){
        return $this->password;
    }
    public function validatePassword($password){
        return $this->getPassword() === sha1($password);
    }
    public function getStatusTitle(){
        $status = UserStatus::find()->where(['id'=>$this->user_status_id])->limit(1)->one();
        return $status->name;
    }
}