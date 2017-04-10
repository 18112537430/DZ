<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "game_estimate".
 *
 * @property string $id
 * @property string $uid
 * @property string $game_id
 * @property integer $hn
 * @property integer $hp
 * @property integer $ln
 * @property integer $left_th
 * @property integer $left_lp
 * @property integer $left_thlp
 * @property integer $left_dz
 * @property integer $left_aa
 * @property integer $right_ydgp
 * @property integer $right_ld
 * @property integer $right_sz
 * @property integer $right_hl
 * @property integer $right_jg
 * @property string $create_at
 */
class GameEstimate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'game_estimate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'game_id', 'hn', 'hp', 'ln', 'left_th', 'left_lp', 'left_thlp', 'left_dz', 'left_aa', 'right_ydgp', 'right_ld', 'right_sz', 'right_hl', 'right_jg'], 'integer'],
            [['hn'], 'required'],
            [['create_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => 'Uid',
            'game_id' => 'Game ID',
            'hn' => 'Hn',
            'hp' => 'Hp',
            'ln' => 'Ln',
            'left_th' => 'Left Th',
            'left_lp' => 'Left Lp',
            'left_thlp' => 'Left Thlp',
            'left_dz' => 'Left Dz',
            'left_aa' => 'Left Aa',
            'right_ydgp' => 'Right Ydgp',
            'right_ld' => 'Right Ld',
            'right_sz' => 'Right Sz',
            'right_hl' => 'Right Hl',
            'right_jg' => 'Right Jg',
            'create_at' => 'Create At',
        ];
    }

    /**
     * @inheritdoc
     * @return GameEstimateQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GameEstimateQuery(get_called_class());
    }
}
