<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bet_type".
 *
 * @property integer $id
 * @property string $name
 * @property double $peilv
 * @property integer $max_show_time
 */
class BetType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bet_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'max_show_time'], 'integer'],
            [['peilv'], 'number'],
            [['name'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'peilv' => 'Peilv',
            'max_show_time' => 'Max Show Time',
        ];
    }

    /**
     * @inheritdoc
     * @return BetTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BetTypeQuery(get_called_class());
    }
}
