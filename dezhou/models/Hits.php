<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hits".
 *
 * @property string $id
 * @property integer $game_id
 * @property string $hits
 * @property string $hit_at
 */
class Hits extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hits';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['game_id'], 'integer'],
            [['hit_at'], 'safe'],
            [['hits'], 'string', 'max' => 60],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'game_id' => 'Game ID',
            'hits' => 'Hits',
            'hit_at' => 'Hit At',
        ];
    }

    /**
     * @inheritdoc
     * @return BetQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BetQuery(get_called_class());
    }
}
