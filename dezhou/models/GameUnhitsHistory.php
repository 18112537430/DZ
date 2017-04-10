<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "game_unhits_history".
 *
 * @property string $id
 * @property string $game_id
 * @property integer $hn
 * @property integer $hp
 * @property integer $ln
 * @property integer $left_th
 * @property integer $left_lp
 * @property integer $left_dz
 * @property integer $left_thlp
 * @property integer $left_aa
 * @property integer $right_ydgp
 * @property integer $right_ld
 * @property integer $right_sz
 * @property integer $right_hl
 * @property integer $right_jg
 * @property string $create_at
 */
class GameUnhitsHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'game_unhits_history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['game_id', 'hn', 'hp', 'ln', 'left_th', 'left_lp', 'left_dz', 'left_thlp', 'left_aa', 'right_ydgp', 'right_ld', 'right_sz', 'right_hl', 'right_jg'], 'integer'],
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
            'game_id' => 'Game ID',
            'hn' => 'Hn',
            'hp' => 'Hp',
            'ln' => 'Ln',
            'left_th' => 'Left Th',
            'left_lp' => 'Left Lp',
            'left_dz' => 'Left Dz',
            'left_thlp' => 'Left Thlp',
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
