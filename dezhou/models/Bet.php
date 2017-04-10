<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bet".
 *
 * @property string $id
 * @property string $game_id
 * @property string $show
 * @property string $show_at
 */
class Bet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bet';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['game_id'], 'integer'],
            [['show_at'], 'safe'],
            [['show'], 'string', 'max' => 30],
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
            'show' => 'Show',
            'show_at' => 'Show At',
        ];
    }
}
