<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rating_time".
 *
 * @property int $id
 * @property string|null $name
 * @property string $date
 *
 * @property Submitted[] $submitteds
 */
class RatingTime extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rating_time';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date'], 'required'],
            [['date'], 'safe'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'date' => 'Date',
        ];
    }

    /**
     * Gets query for [[Submitteds]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubmitteds()
    {
        return $this->hasMany(Submitted::className(), ['rating_time_id' => 'id']);
    }
}
