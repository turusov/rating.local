<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "submitted".
 *
 * @property int $id
 * @property int $user_id
 * @property int $criteria_id
 * @property int $value
 *
 * @property Criteria $criteria
 * @property User $user
 */
class Submitted extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'submitted';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'criteria_id', 'value'], 'required'],
            [['user_id', 'criteria_id', 'value'], 'integer'],
            [['criteria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Criteria::className(), 'targetAttribute' => ['criteria_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'criteria_id' => 'Criteria ID',
            'value' => 'Value',
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
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
