<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[BetType]].
 *
 * @see BetType
 */
class BetTypeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return BetType[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return BetType|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
