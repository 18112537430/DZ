<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hit_bets".
 *
 * @property string $id
 * @property string $game_id
 * @property string $bet_id
 * @property integer $uid
 * @property string $hit_id
 * @property string $hit_total_money
 * @property string $get_total_money
 * @property string $yl_total_money
 * @property string $desc
 * @property string $bet_time
 * @property string $end_time
 * @property string $status
 */
class HitBets extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hit_bets';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'game_id', 'bet_id', 'uid', 'hit_id'], 'integer'],
            [['hit_total_money', 'get_total_money', 'yl_total_money'], 'number'],
            [['bet_time', 'end_time'], 'safe'],
            [['status'], 'string'],
            [['desc'], 'string', 'max' => 255],
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
            'bet_id' => 'Bet ID',
            'uid' => 'Uid',
            'hit_id' => 'Hit ID',
            'hit_total_money' => 'Hit Total Money',
            'get_total_money' => 'Get Total Money',
            'yl_total_money' => 'Yl Total Money',
            'desc' => 'Desc',
            'bet_time' => 'Bet Time',
            'end_time' => 'End Time',
            'status' => 'Status',
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
