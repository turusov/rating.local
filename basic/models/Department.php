<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "department".
 *
 * @property int $id
 * @property int $faculty_id
 * @property string $title
 *
 * @property Faculty $faculty
 * @property UserData[] $userDatas
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'department';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['faculty_id', 'title'], 'required'],
            [['faculty_id'], 'integer'],
            [['title'], 'string', 'max' => 100],
            [['faculty_id'], 'exist', 'skipOnError' => true, 'targetClass' => Faculty::className(), 'targetAttribute' => ['faculty_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'faculty_id' => 'Faculty ID',
            'title' => 'Title',
        ];
    }

    /**
     * Gets query for [[Faculty]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFaculty()
    {
        return $this->hasOne(Faculty::className(), ['id' => 'faculty_id']);
    }

    /**
     * Gets query for [[UserDatas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserDatas()
    {
        return $this->hasMany(UserData::className(), ['department_id' => 'id']);
    }
    public static function getDepartmentTitle($department_id)
    {
       $object = static::findOne(['id' => $department_id]); 
       return $object ? $object->title : null;
    }
}
