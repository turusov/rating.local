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
 *
 * @property Block $block
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
            [['criteria_id', 'access', 'is_deleted', 'block_id'], 'integer'],
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
            'criteria_title' => 'Criteria Title',
            'info_point' => 'Info Point',
            'access' => 'Access',
            'is_deleted' => 'Is Deleted',
            'block_id' => 'Block ID',
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
}
