<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "criteria_access".
 *
 * @property int $id
 * @property int $criteria_id
 * @property int|null $user_status_id
 *
 * @property Criteria $criteria
 * @property UserStatus $userStatus
 */
class CriteriaAccess extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'criteria_access';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['criteria_id', 'user_status_id'], 'required'],
            [['criteria_id', 'user_status_id'], 'integer'],
            [['criteria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Criteria::className(), 'targetAttribute' => ['criteria_id' => 'id']],
            [['user_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserStatus::className(), 'targetAttribute' => ['user_status_id' => 'id']],
            [['criteria_id'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'criteria_id' => 'Criteria ID',
            'user_status_id' => 'User Status ID',
        ];
    }

    /**
     * Gets query for [[Criteria]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCriteria()
    {
        return $this->hasOne(Criteria::className(), ['id' => 'criteria_id']);
    }

    /**
     * Gets query for [[UserStatus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserStatus()
    {
        return $this->hasOne(UserStatus::className(), ['id' => 'user_status_id']);
    }

    // private $_criteria_id=null;
    // public function init()
    // {
    //     $this->on(static::EVENT_AFTER_INSERT, [$this, 'criteria_id']);
    //     $this->on(static::EVENT_AFTER_UPDATE, [$this, 'criteria_id']);
    //     parent::init();
    // }
    // public function setCriteriaId($ids)
    // {
    //     $this->_criteria_id = (array) $ids;
    // }

    // protected function saveCriteriaId()
    // {
    // //сброс всех текущих связей
    //     $this->unlinkAll('criterias', true);
    //     $criterias = Criteria::find()->where(['id' => $this->_criterias_id])->all();
    //     foreach ($criterias as $criteria) {
    //         //Здесь Ваш способ линкования моделей. У меня это делается вот так:
    //         $this->criterias = $criteria;
    //     }
    // }
    // public function getCriteria()
    // {
    //     return $this->getRelation('criterias')->indexBy('id')->select('id')->column();
    // }
}
