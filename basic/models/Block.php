<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "block".
 *
 * @property int $id
 * @property string $title
 * @property string|null $commentary
 *
 * @property Criteria[] $criterias
 */
class Block extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'block';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['id'], 'integer'],
            [['title', 'commentary'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название блока',
            'commentary' => 'Комментарий(необязательно)',
        ];
    }

    /**
     * Gets query for [[Criterias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCriterias()
    {
        return $this->hasMany(Criteria::className(), ['block_id' => 'id']);
    }
    public static function getBlockName($block_id)
    {
        return static::findOne(['id' => $block_id])->title;
    }
    public static function getFacultyTitle($faculty_id)
    {
       return static::findOne(['id' => $faculty_id])->title; 
    }
}
