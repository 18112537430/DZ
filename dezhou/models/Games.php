<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "games".
 *
 * @property string $id
 * @property integer $uid
 * @property string $hn
 * @property string $ln
 * @property integer $hp
 * @property integer $left_th
 * @property integer $left_lp
 * @property integer $left_dz
 * @property integer $left_thlp
 * @property integer $left_aa
 * @property integer $right_dz
 * @property integer $right_ld
 * @property integer $right_sz
 * @property integer $right_hl
 * @property integer $right_jg
 * @property integer $left_th_t
 * @property integer $left_lp_t
 * @property integer $left_dz_t
 * @property integer $left_thlp_t
 * @property integer $left_aa_t
 * @property integer $right_ld_t
 * @property integer $right_dz_t
 * @property integer $right_sz_t
 * @property integer $right_hl_t
 * @property integer $right_jg_t
 * @property integer $hp_t
 * @property integer $times
 * @property string $win
 * @property string $yingli
 * @property string $cb
 * @property string $is_win
 * @property string $end_at
 * @property string $create_at
 * @property double $per_hn
 * @property double $per_hp
 * @property double $per_ln
 * @property double $per_left_th
 * @property double $per_left_lp
 * @property double $per_left_dz
 * @property double $per_left_thlp
 * @property double $per_left_aa
 * @property double $per_right_ydgp
 * @property double $per_right_lz
 * @property double $per_right_sz
 * @property double $per_right_hl
 * @property double $per_right_jg
 */
class Games extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'games';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['win', 'yingli', 'cb', 'per_hn', 'per_hp', 'per_ln', 'per_left_th', 'per_left_lp', 'per_left_dz', 'per_left_thlp', 'per_left_aa', 'per_right_ydgp', 'per_right_lz', 'per_right_sz', 'per_right_hl', 'per_right_jg'], 'number'],
            [['is_win'], 'string'],
            [['end_at', 'create_at'], 'safe'],
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
            'hn' => 'Hn',
            'ln' => 'Ln',
            'hp' => 'Hp',
            'left_th' => 'Left Th',
            'left_lp' => 'Left Lp',
            'left_dz' => 'Left Dz',
            'left_thlp' => 'Left Thlp',
            'left_aa' => 'Left Aa',
            'right_dz' => 'Right Dz',
            'right_ld' => 'Right Ld',
            'right_sz' => 'Right Sz',
            'right_hl' => 'Right Hl',
            'right_jg' => 'Right Jg',
            'left_th_t' => 'Left Th T',
            'left_lp_t' => 'Left Lp T',
            'left_dz_t' => 'Left Dz T',
            'left_thlp_t' => 'Left Thlp T',
            'left_aa_t' => 'Left Aa T',
            'right_ld_t' => 'Right Ld T',
            'right_dz_t' => 'Right Dz T',
            'right_sz_t' => 'Right Sz T',
            'right_hl_t' => 'Right Hl T',
            'right_jg_t' => 'Right Jg T',
            'hp_t' => 'Hp T',
            'times' => 'Times',
            'win' => 'Win',
            'yingli' => 'Yingli',
            'cb' => 'Cb',
            'is_win' => 'Is Win',
            'end_at' => 'End At',
            'create_at' => 'Create At',
            'per_hn' => 'Per Hn',
            'per_hp' => 'Per Hp',
            'per_ln' => 'Per Ln',
            'per_left_th' => 'Per Left Th',
            'per_left_lp' => 'Per Left Lp',
            'per_left_dz' => 'Per Left Dz',
            'per_left_thlp' => 'Per Left Thlp',
            'per_left_aa' => 'Per Left Aa',
            'per_right_ydgp' => 'Per Right Ydgp',
            'per_right_lz' => 'Per Right Lz',
            'per_right_sz' => 'Per Right Sz',
            'per_right_hl' => 'Per Right Hl',
            'per_right_jg' => 'Per Right Jg',
        ];
    }

    /**
     * @inheritdoc
     * @return GaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GaQuery(get_called_class());
    }
}
