<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "faculty".
 *
 * @property int $id
 * @property string $title
 *
 * @property Department[] $departments
 * @property UserData[] $userDatas
 */
class Faculty extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'faculty';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    /**
     * Gets query for [[Departments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartments()
    {
        return $this->hasMany(Department::className(), ['faculty_id' => 'id']);
    }

    /**
     * Gets query for [[UserDatas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserDatas()
    {
        return $this->hasMany(UserData::className(), ['faculty_id' => 'id']);
    }
    public static function getFacultyTitle($faculty_id)
    {
       return static::findOne(['id' => $faculty_id])->title; 
    }
}
