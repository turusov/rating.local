<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "criteria".
 *
 * @property int $id
 * @property int $criteria_id
 * @property string $criteria_title
 * @property string $info_point
 * @property int $access
 * @property int|null $is_deleted
 * @property int $block_id
 * @property int|null $min_value
 * @property int|null $max_value
 *
 * @property Block $block
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
            [['criteria_id', 'criteria_title', 'info_point', 'block_id'], 'required'],
            [['criteria_id', 'access', 'is_deleted', 'block_id', 'min_value', 'max_value', 'is_subtract'], 'integer'],
            [['criteria_title', 'info_point'], 'string', 'max' => 255],
            [['block_id'], 'exist', 'skipOnError' => true, 'targetClass' => Block::className(), 'targetAttribute' => ['block_id' => 'id']],
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
            'criteria_title' => 'Название критерия',
            'info_point' => 'Информация о баллах',
            'access' => 'Доступ',
            'is_deleted' => 'Активен в текущем году',
            'block_id' => 'Block ID',
            'min_value' => 'Минимальное значение',
            'max_value' => 'Максимальное значение',
        ];
    }

    /**
     * Gets query for [[Block]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBlock()
    {
        return $this->hasOne(Block::className(), ['id' => 'block_id']);
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
