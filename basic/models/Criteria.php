<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "criteria".
 *
 * @property int $id
 * @property string $criteria
 * @property string $info_point
 * @property int $access
 * @property int|null $is_deleted
 * @property int $blog
 *
 * @property Submitted[] $submitteds
 */
class Criteria extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'criteria';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['criteria', 'info_point', 'access', 'blog'], 'required'],
            [['access', 'is_deleted', 'blog'], 'integer'],
            [['criteria', 'info_point'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'criteria' => 'Criteria',
            'info_point' => 'Info Point',
            'access' => 'Access',
            'is_deleted' => 'Is Deleted',
            'blog' => 'Blog',
        ];
    }

    /**
     * Gets query for [[Submitteds]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubmitteds()
    {
        return $this->hasMany(Submitted::className(), ['criteria_id' => 'id']);
    }
}
