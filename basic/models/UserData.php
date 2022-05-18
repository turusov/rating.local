<?php

namespace app\models;

use Yii;
use app\models\Department;
class UserData extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'user_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'department_id', 'faculty_id'], 'required'],
            [['user_id', 'department_id', 'faculty_id', 'work_rate'], 'integer'],
            [['name', 'surname'], 'string', 'max' => 30],
            [['patronymic'], 'string', 'max' => 40],
            [['academic_rank'], 'string', 'max' => 50],
            [['academic_rank'], 'default', 'value'=>null],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['department_id' => 'id']],
            [['faculty_id'], 'exist', 'skipOnError' => true, 'targetClass' => Faculty::className(), 'targetAttribute' => ['faculty_id' => 'id']],
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
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'department_id' => 'Department ID',
            'faculty_id' => 'Faculty ID',
        ];
    }

    /**
     * Gets query for [[Department]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'department_id']);
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
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    public function calculateRating()
    {
        $submitteds = Submitted::find()->where(['user_id'=>$this->user_id])->all();
        $criterias = Criteria::find()->all();
        $sum = 0;
        $array = array();
        foreach($criterias as $criteria)
        {
            $array[$criteria->id] = $criteria->is_subtract;
        }

        foreach($submitteds as $submitted)
        {
            if(is_null($array[$submitted->criteria_id]))
                $sum+= $submitted->value;
            else
                $sum-= $submitted->value;
        }
        return $sum;
    }
}
