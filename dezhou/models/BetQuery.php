<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Hits]].
 *
 * @see Hits
 */
class BetQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Hits[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Hits|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
